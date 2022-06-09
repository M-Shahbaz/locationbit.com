import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const AdsenseBanner = props => {
    useEffect(() => {
        (window.adsbygoogle = window.adsbygoogle || []).push({});
    }, [])


    return (
        <div>
            <ins class="adsbygoogle"
                data-ad-client="ca-pub-4483485667832613"
                data-ad-slot="7782857682"
                data-ad-format="auto"
                data-full-width-responsive="true">
                <Script
                    src={`https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4483485667832613`}
                    strategy="afterInteractive"
                ></Script></ins>
        </div>
    );

};

export default AdsenseBanner;