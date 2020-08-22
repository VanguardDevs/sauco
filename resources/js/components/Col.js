import React from 'react';
import PropTypes from 'prop-types';

const colWidths = ['xs', 'sm', 'md', 'lg', 'xl'];

const columnProps = PropTypes.oneOfType([
  PropTypes.bool,
  PropTypes.number,
  PropTypes.string
]);

const defaultProps = {
  tag: 'div',
  widths: colWidths
};

const propTypes = {
  children: PropTypes.node.isRequired,
  xs: columnProps,
  sm: columnProps,
  md: columnProps,
  lg: columnProps,
  xl: columnProps,
};

const getColumnSizeClass = (colWidth, colSize) => (
  `col-${colWidth}-${colSize}`
);

const Col = (props) => {
  const {
    tag: Tag,
    widths
  } = props;

  const colClasses = [];
  
  widths.forEach((colWidth, i) => {
    let columnProp = props[colWidth];

    const colClass = getColumnSizeClass(colWidth, columnProp);
    colClasses.push(colClass);
  });

  const classes = colClasses.join(' ');

  return (
    <Tag className={classes}>
      {props.children}
    </Tag>
  );
};

Col.propTypes = propTypes;
Col.defaultProps = defaultProps;

export default Col;

