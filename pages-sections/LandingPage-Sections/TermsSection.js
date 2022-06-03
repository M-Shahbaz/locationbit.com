import React from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/workStyle.js";
import dynamic from 'next/dynamic';

const Ad728x90 = dynamic(
  () => import('../../components/Ad/Ad728x90'),
  { ssr: false }
);

const useStyles = makeStyles(styles);

export default function TermsSection() {
  const classes = useStyles();
  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem cs={12} sm={12} md={8}>
          <h2 className={classes.title}>Locationbit.com terms of service</h2>
          <h4 className={classes.description}>
          </h4>
          <Ad728x90 />
          <div class="align-left" className={classes.description}>


            <div>
              <div>
                <h3>Welcome to Locationbit.com!</h3>
                <p>Thanks for using our service. The Service is provided by Locationbit.com (“Locationbit.com”). <br />
                  By using our Service, you are agreeing to these terms. Please read them carefully.
                  <br />
                  Our Service is very diverse, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services.
                  <br />
                  Copyright &copy; {1900 + new Date().getYear()} locationbit.com@gmail.com
                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Using our Services</h3>
                <p>You must follow any policies made available to you within the Services.<br />
                  This website “locationbit.com” may be used for legal purposes only.  Users take full responsibility for any actions performed using this website.  The website owner of locationbit.com accepts no liability for damage caused by this website’s service. If these terms are not acceptable to you, then do not use this website.<br />
                  This website is a free service. This website provides distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.<br />
                  Don’t misuse our Services. For example, don’t interfere with our Services or try to access them using a method other than the interface and the instructions that we provide. You may use our Services only as permitted by law. We may suspend or stop providing our Services to you if you do not comply with our terms or policies or if we are investigating suspected misconduct.<br />
                  Using our Services does not give you ownership of any intellectual property rights in our Services or the content you access. You may not use content from our Services unless you obtain permission from its owner or are otherwise permitted by law. These terms do not grant you the right to use any branding or logos used in our Services. Don’t remove, obscure, or alter any legal notices displayed in or along with our Services.<br />
                  In connection with your use of the Services, we may send you service announcements, administrative messages, and other information. You may opt out of some of those communications.<br />
                  Some of our Services are available on mobile devices. Do not use such Services in a way that distracts you and prevents you from obeying traffic or safety laws.

                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Privacy and Copyright Protection</h3>
                <p>We don’t collect your account password in anyway only your email address and your public information at the time of authentication with Locationbit.com Google Application.<br />
                  We do not share with third parties or sell your personal data and we protect your privacy when you use our Services. By using our Services, you agree that Locationbit.com can use such data in accordance with our privacy policies.<br />
                  We respond to notices of alleged copyright infringement and terminate accounts of repeat infringers according to the process set out in the U.S. Digital Millennium Copyright Act.<br />
                  We provide information to help copyright holders manage their intellectual property online. If you think somebody is violating your copyrights and want to notify us, you can query us at locationbit.com@gmail.com

                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Access to the Website</h3>
                <p>The Website is made available free of charge and the Services are available only for informational purposes.
                  We make no representations or warranties of any kind as to the accuracy, currency, or completeness of the information and other materials made available through the Website and are not liable for any decisions you may make in reliance on this content.
                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Modifying and Terminating our Services</h3>
                <p>We are constantly changing and improving our Services. We may add or remove functionalities or features, and we may suspend or stop a Service altogether.<br />
                  You can stop using our Services at any time, although we’ll be sorry to see you go. Locationbit.com may also stop providing Services to you, or add or create new limits to our Services at any time.<br />
                  We believe that you own your data and preserving your access to such data is important. If we discontinue a Service, where reasonably possible, we will give you reasonable advance notice and a chance to get information out of that Service.


                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Limits on Liability</h3>
                <p>We work hard to provide the best Website and Services we can and to specify clear guidelines for everyone who uses them. Our Website and Services, however, are provided "as is," and we make no guarantees that they always will be safe, secure, or error-free, that they will function without disruptions, delays, or imperfections or content will be accurate, current and complete. To the extent permitted by law, we also DISCLAIM ALL WARRANTIES, WHETHER EXPRESS OR IMPLIED, INCLUDING THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, TITLE AND NON-INFRINGEMENT IN RELATION TO THE WEBSITE, THE SERVICES AND THEIR CONTENT. We do not control or direct what people and others do or say, and we are not responsible for their actions or conduct (whether online or offline) or any content they share (including offensive, inappropriate, obscene, unlawful, and other objectionable content). Some jurisdictions do not allow the exclusion or limitation of implied warranties, in which case parts of this disclaimer may not apply to you.

                  We cannot predict when issues might arise with our Website and Services. Accordingly, our liability shall be limited to the fullest extent permitted by applicable law, and under no circumstance will we be liable to you for any lost profits, revenues, information, or data, or consequential, special, indirect, exemplary, punitive, or incidental damages arising out of or related to these Terms, the Website or the Services, even if we have been advised of the possibility of such damages. Our aggregate liability arising out of or relating to these Terms, the Website or the Services will not exceed $0.1.

                  We do not exclude or limit in any way our liability to you where it would be unlawful to do so therefore depending on the country where you reside some of these exclusions and limitations may not apply to you.
                </p>
              </div>

            </div>

            <div>
              <div>
                <h3>Use of Cookies</h3>
                <p>As most of the online services, our website uses first-party and third-party cookies for several purposes. First-party cookies are mostly necessary for the website to function the right way, and they do not collect any of your personally identifiable data.

                The third-party cookies used on our website are mainly for understanding how the website performs, how you interact with our website, keeping our services secure, providing advertisements that are relevant to you, and all in all providing you with a better and improved user experience and help speed up your future interactions with our website.
                </p>
              </div>

            </div>

            <div>
              <div>
                <h4>You are encouraged to send comments, improvements or suggestions at locationbit.com@gmail.com </h4>

              </div>

            </div>

          </div>
          <br />

        </GridItem>
      </GridContainer>
    </div>
  );
}
