import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const Adinterstitial = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_14714251" data-placement="interstitial" data-size="Responsive">
                <Script
                    src={`//mahimeta.com/networks/tag.js?cache=${cachebuster}`}
                    strategy="beforeInteractive"
                ></Script>
            </ins>
        </div>
    );

};

export default Adinterstitial;