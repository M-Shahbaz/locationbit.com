import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const AdsenseInArticle = props => {
    useEffect(() => {
        (window.adsbygoogle = window.adsbygoogle || []).push({});
    }, [])


    return (
        <div>
            <ins class="adsbygoogle"
                style={{ display: "block", textAlign: "center" }}
                data-ad-layout="in-article"
                data-ad-format="fluid"
                data-ad-client="ca-pub-4483485667832613"
                data-ad-slot="5804681160">
            </ins>
        </div>
    );

};

export default AdsenseInArticle;