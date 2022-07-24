const formatServerSideErrors = (errors, func) => {
    Object.keys(errors).forEach(key => {
        console.log(errors, func)
        func(key, errors[key])
    });
}

export default formatServerSideErrors
