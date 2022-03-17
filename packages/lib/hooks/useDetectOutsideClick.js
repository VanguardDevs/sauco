import * as React from 'react'

const useDetectOutsideClick = (ref) => {
    const [status, setStatus] = React.useState(false)

    React.useEffect(() => {
        /**
         * Alert if clicked on outside of element
         */
        function handleClickOutside(event) {
            if (ref.current && !ref.current.contains(event.target)) {
                setStatus(true);
                return;
            }
            setStatus(false);
        }

        // Bind the event listener
        document.addEventListener("mousedown", handleClickOutside);
        return () => {
            // Unbind the event listener on clean up
            document.removeEventListener("mousedown", handleClickOutside);
        };
    }, [ref]);

    return status;
}

export default useDetectOutsideClick
