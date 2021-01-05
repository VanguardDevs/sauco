import React, { useState, useEffect } from 'react';

const isMobile = ( breakpoint ) => {
  const [width, setWidth] = useState(window.innerWidth)
  useEffect(() => {
    const handleResize = () => {
      setWidth(window.innerWidth)
    }
    
    window.addEventListener('resize', handleResize)
    return () => { window.removeEventListener('resize', handleResize) }
  }, []);

  return (width < breakpoint ? true : false)
}

export default isMobile;
