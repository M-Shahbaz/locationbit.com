import Reactl, { useEffect } from 'react';

const AdFooterSticky = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_94177379" data-placement="floating" data-size="Responsive" data-desktop="970x90" data-tablet="728x90" data-mobile="320x100" style={{ display: "inline-block" }}>
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

export default AdFooterSticky;