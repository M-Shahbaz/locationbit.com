import Reactl, { useEffect } from 'react';

const Ad300x600 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_59675004" data-size="Responsive" data-desktop="300x600" data-tablet="300x250" data-mobile="320x100" style={{ display: "inline-block" }}>

            </ins>
        </div>
    );

};

export default Ad300x600;