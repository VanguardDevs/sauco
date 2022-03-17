import React, { useEffect } from "react";
import {
  useNotify,
  useDelete,
  useRefresh,
  useRedirect,
} from 'react-admin';
import ButtonMenu from './ButtonMenu';
// Icons
import IconButton from '@material-ui/core/IconButton';
import DeleteIcon from '@material-ui/icons/Delete';
import Visibility from '@material-ui/icons/Visibility';
import EditIcon from '@material-ui/icons/Edit';
import { Menu } from '@material-ui/core';
import MoreVertIcon from '@material-ui/icons/MoreVert';

const ITEM_HEIGHT = 48;

const ref =  React.createRef();

const MenuActions = props => {
  const refresh = useRefresh();
  const redirect = useRedirect();
  const notify = useNotify();
  const {
    resource,
    basePath,
    shouldEdit,
    shouldDelete,
    shouldShow,
    record,
    children
  } = props;
  const [anchorEl, setAnchorEl] = React.useState(null);
  const open = Boolean(anchorEl);

  const [deleteOne, {
    data,
    loaded,
    error
  }] = useDelete(resource, record.id);

  useEffect(() => {
    (async function () {
      if (loaded) {
        await notify(data.message);
        await refresh();
      }
    })();
  }, [loaded]);

  if (error) return notify('Ha ocurrido un error');

  const handleClick = (e) => setAnchorEl(e.currentTarget);

  const handleClose = () => setAnchorEl(null);

  const childrenWithProps = children => {
    if (children) {
      return React.cloneElement(children, { onClick: handleClose, ref: ref, record: record });
    }
  }

  return (
    <div>
      <IconButton
        aria-label="Opciones"
        aria-controls="long-menu"
        aria-haspopup="true"
        onClick={handleClick}
      >
        <MoreVertIcon />
      </IconButton>
      <Menu
        anchorEl={anchorEl}
        keepMounted
        open={open}
        onClose={handleClose}
        PaperProps={{
          style: {
            maxHeight: ITEM_HEIGHT * 4.5,
            width: '16ch',
          },
        }}
      >
        {childrenWithProps(children)}

        { (shouldShow) &&
          <ButtonMenu
            label={shouldShow.label ? shouldShow.label : '  Ver'}
            icon={<Visibility />}
            onClick={
              (e) => {
                redirect(`${basePath}/${record.id}/show`);
                handleClose();
            }}
            ref={ref}
          />
        }
        { (shouldEdit) &&
          <ButtonMenu
            label={shouldEdit.label ? shouldEdit.label : 'Editar' }
            icon={<EditIcon />}
            onClick={() => {
              redirect(basePath + '/' + record.id);
              handleClose();
            }}
            ref={ref}
          />
        }
        { (shouldDelete) &&
          <ButtonMenu
            label={shouldDelete.label ? shouldDelete.label : 'Eliminar'}
            icon={<DeleteIcon />}
            onClick={
              (e) => {
                deleteOne();
                handleClose();
            }}
            ref={ref}
          />
        }
      </Menu>
    </div>
  );
};

export default MenuActions;

