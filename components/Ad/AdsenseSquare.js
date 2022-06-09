import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const AdsenseSquare = props => {
    useEffect(() => {
        (window.adsbygoogle = window.adsbygoogle || []).push({});
    }, [])


    return (
        <div>
            <ins class="adsbygoogle"
                style={{ display: "block" }}
                data-ad-client="ca-pub-4483485667832613"
                data-ad-slot="5348266034"
                data-ad-format="auto"
                data-full-width-responsive="true">
            </ins>
        </div >
    );

};

export default AdsenseSquare;