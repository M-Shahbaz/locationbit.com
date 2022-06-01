import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const Ad300x250 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_89924920" data-size="Responsive" data-desktop="300x250" data-tablet="300x250" data-mobile="300x250" style={{ display: "inline-block" }}>
                <Script
                    src={`//mahimeta.com/networks/tag.js?cache=${cachebuster}`}
                    strategy="beforeInteractive"
                ></Script>
            </ins>
        </div>
    );

};

export default Ad300x250;