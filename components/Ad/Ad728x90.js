import Reactl, { useEffect } from 'react';

const Ad728x90 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_77672718" data-size="Responsive" data-desktop="728x90" data-tablet="320x100" data-mobile="320x100" style={{ display: "inline-block" }}>

            </ins>
        </div>
    );

};

export default Ad728x90;