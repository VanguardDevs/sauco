import React from 'react';
import { ToastContainer, toast, Slide } from 'react-toastify';

import 'react-toastify/dist/ReactToastify.css';

export const ToastWrapper = () => (
  <ToastContainer
    position="bottom-center"
    hideProgressBar
    newestOnTop={false}
    rtl={false}
    pauseOnFocusLoss={false}
    draggable={false}
    transition={Slide}
    autoClose={2500}
    closeButton={false}
  />
);

export const Success = (message) => toast.success(`${message}`);

export const Error = (message) => toast.error(`${message}`);

export const Warning = (message) => toast.warning(`${message}`);
 
