import React from 'react';

const AdMain = props => {

    return (
        <ins className="widgetsbymahimeta" id="mMTag_News_29474807" data-type="news" data-color="blue" style={{ display: "block", width: "100%" }}>
            <script
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

export default AdMain;