import Reactl, { useEffect } from 'react';

const AdFooterSticky = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_94177379" data-placement="floating" data-size="Responsive" data-desktop="970x90" data-tablet="728x90" data-mobile="320x100" style={{ display: "inline-block" }}>
            </ins>
        </div>
    );

};

export default AdFooterSticky;