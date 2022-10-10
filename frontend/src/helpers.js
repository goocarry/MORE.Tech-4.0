import { useEffect, useState } from 'react';


export const useIsDidMount = () => {
    const [isDidMount, updateIsDidMount] = useState(false);

    useEffect(() => {
        updateIsDidMount(true);
    }, []);

    return isDidMount;
};

export const sleep = (timeout) => new Promise((resolve) => {
    setTimeout(resolve, timeout);
});

export const useBeforeRendering = (callback) => {
    const isDidMount = useIsDidMount();

    if (!isDidMount) {
        callback();
    }
};
