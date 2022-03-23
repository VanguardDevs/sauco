import * as React from 'react';
import Spinner from './Spinner';

class LazyLoader extends React.PureComponent {
    render() {
        const { children, loader } = this.props;

        return (
        <React.Suspense fallback={(loader) ? <Spinner /> : <></>}>
            {children}
        </React.Suspense>
        )
    }
}

export default LazyLoader;
