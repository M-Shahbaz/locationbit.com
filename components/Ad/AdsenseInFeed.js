import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const AdsenseInFeed = props => {
    useEffect(() => {
        (window.adsbygoogle = window.adsbygoogle || []).push({});
    }, [])


    return (
        <div key={currentPath}>
            <ins class="adsbygoogle"
                style={{ display: "block" }}
                data-ad-format="fluid"
                data-ad-layout-key="-6t+ed+2i-1n-4w"
                data-ad-client="ca-pub-4483485667832613"
                data-ad-slot="6429413419">
                <Script
                    src={`https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4483485667832613`}
                    strategy="afterInteractive"
                ></Script>
            </ins>
        </div>
    );

};

export default AdsenseInFeed;