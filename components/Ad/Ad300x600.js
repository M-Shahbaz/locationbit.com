import Reactl, { useEffect } from 'react';

const Ad300x600 = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_59675004" data-size="Responsive" data-desktop="300x600" data-tablet="300x250" data-mobile="320x100" style={{ display: "inline-block" }}>
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
        </div>
    );

};

export default Ad300x600;