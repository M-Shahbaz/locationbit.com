import Reactl, { useEffect } from 'react';

const Ad336x280 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_44229962" data-size="Responsive" data-desktop="336x280" data-tablet="336x280" data-mobile="336x280" style={{ display: "inline-block" }}>
            </ins>
        </div>
    );

};

export default Ad336x280;