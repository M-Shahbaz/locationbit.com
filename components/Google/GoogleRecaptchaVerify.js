import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux'
import { GoogleReCaptcha } from 'react-google-recaptcha-v3';

const GoogleRecaptchaVerify = props => {
    const dispatch = useDispatch();
    const reCaptchaSiteKeyObj =
    {
        keyNumber: props.keyNumber,
    };

    const recaptchaDispatch = () =>
        dispatch({
            type: 'RECAPTCHA', recaptcha: reCaptchaSiteKeyObj
        });

    const handleVerify = (token) => {
        // console.log(token);
        reCaptchaSiteKeyObj.token = token;
        recaptchaDispatch();
    };


    return (
        <div>
            <GoogleReCaptcha onVerify={handleVerify} />
        </div>
    );

};

export default GoogleRecaptchaVerify;