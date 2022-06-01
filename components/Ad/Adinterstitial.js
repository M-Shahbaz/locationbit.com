import Reactl, { useEffect } from 'react';

const Adinterstitial = props => {
    const { currentPath } = props;
    useEffect(() => {
        window.mMLoaded = window.mMLoaded || []
        window.mMLoaded.push({})
    }, [currentPath])


    return (
        <div key={currentPath}>
            <ins class="adsbymahimeta" id="mMTag_Responsive_14714251" data-placement="interstitial" data-size="Responsive">
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

export default Adinterstitial;