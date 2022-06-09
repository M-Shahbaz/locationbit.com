import Reactl, { useEffect } from 'react';
import Script from 'next/script'

const AdsenseMutiplexHorizontal = props => {
    useEffect(() => {
        (window.adsbygoogle = window.adsbygoogle || []).push({});
    }, [])


    return (
        <div>
            <ins class="adsbygoogle"
                style={{ display: "inline-block", width: "100%" }}
                data-ad-format="autorelaxed"
                data-ad-client="ca-pub-4483485667832613"
                data-ad-slot="8198624801">
            </ins>
        </div >
    );

};

export default AdsenseMutiplexHorizontal;