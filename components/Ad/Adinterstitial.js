import Reactl, { useEffect } from 'react';

const interstitial = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_14714251" data-placement="interstitial" data-size="Responsive">
            </ins>
        </div>
    );

};

export default interstitial;