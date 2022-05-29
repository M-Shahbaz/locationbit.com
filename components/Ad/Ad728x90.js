import React from 'react';

const Ad728x90 = props => {

    return (
        <ins class="adsbymahimeta" id="mMTag_Responsive_77672718" data-size="Responsive" data-desktop="728x90" data-tablet="320x100" data-mobile="320x100" style={{ display: "inline-block" }}>
            <script
                async
                dangerouslySetInnerHTML={{
                    __html: `
                    var cachebuster = Math.round(new Date().getTime() / 1000); 
                    var mMTagScript = document.createElement('script'); 
                    mMTagScript.src = '//mahimeta.com/networks/tag.js?cache='+cachebuster; 
                    document.getElementsByTagName("head")[0].appendChild(mMTagScript);
                `,
                }}
            />
        </ins>
    );

};

export default Ad728x90;