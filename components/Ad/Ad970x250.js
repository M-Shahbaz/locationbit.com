import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const Ad970x250 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_33303000" data-size="Responsive" data-desktop="970x300" data-tablet="728x90" data-mobile="320x100" style={{ display: "inline-block" }}>
                <Script
                    src={`//mahimeta.com/networks/tag.js?cache=${cachebuster}`}
                    strategy="beforeInteractive"
                ></Script>
            </ins>
        </div>
    );

};

export default Ad970x250;