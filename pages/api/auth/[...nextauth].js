import NextAuth from "next-auth"
import Providers from "next-auth/providers"
import jwt from "jsonwebtoken";
import { v4 as uuidv4 } from 'uuid';

const maxAge = 30 * 24 * 60 * 60

// For more information on each option (and a full list of options) go to
// https://next-auth.js.org/configuration/options
export default NextAuth({
  // https://next-auth.js.org/configuration/providers
  providers: [
    // Providers.Email({
    //   server: process.env.EMAIL_SERVER,
    //   from: process.env.EMAIL_FROM,
    // }),
    // Temporarily removing the Apple provider from the demo site as the
    // callback URL for it needs updating due to Vercel changing domains
    /*
    Providers.Apple({
      clientId: process.env.APPLE_ID,
      clientSecret: {
        appleId: process.env.APPLE_ID,
        teamId: process.env.APPLE_TEAM_ID,
        privateKey: process.env.APPLE_PRIVATE_KEY,
        keyId: process.env.APPLE_KEY_ID,
      },
    }),
    */
    Providers.Google({
      clientId: process.env.GOOGLE_ID,
      clientSecret: process.env.GOOGLE_SECRET,
    }),
    Providers.Facebook({
      clientId: process.env.FACEBOOK_ID,
      clientSecret: process.env.FACEBOOK_SECRET,
    }),
    Providers.Twitter({
      clientId: process.env.TWITTER_ID,
      clientSecret: process.env.TWITTER_SECRET,
    }),
    // {
    //   id: 'microsoft',
    //   name: 'Microsoft',
    //   type: 'oauth',
    //   version: '2.0',
    //   scope: 'https://graph.microsoft.com/user.read',
    //   params: { grant_type: 'authorization_code' },
    //   accessTokenUrl: 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
    //   authorizationUrl: 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize?response_type=code&response_mode=query',
    //   profileUrl: 'https://graph.microsoft.com/v1.0/me/',
    //   profile: profile => {
    //     console.log(profile);
    //     return {
    //       id: profile.id,
    //       name: profile.displayName,
    //       last_name: profile.surname,
    //       first_name: profile.givenName,
    //       email: profile.mail ? profile.mail : profile.userPrincipalName,
    //     };
    //   },
    //   clientId: process.env.MICROSOFT_ID,
    //   clientSecret: process.env.MICROSOFT_SECRET,
    // },
    Providers.GitHub({
      clientId: process.env.GITHUB_ID,
      clientSecret: process.env.GITHUB_SECRET,
    }),
    // Providers.Auth0({
    //   clientId: process.env.AUTH0_ID,
    //   clientSecret: process.env.AUTH0_SECRET,
    //   domain: process.env.AUTH0_DOMAIN,
    // }),
  ],
  // Database optional. MySQL, Maria DB, Postgres and MongoDB are supported.
  // https://next-auth.js.org/configuration/databases
  //
  // Notes:
  // * You must install an appropriate node_module for your database
  // * The Email provider requires a database (OAuth providers do not)
  // database: process.env.DATABASE_URL,

  // The secret should be set to a reasonably long random string.
  // It is used to sign cookies and to sign and encrypt JSON Web Tokens, unless
  // a separate secret is defined explicitly for encrypting the JWT.
  secret: process.env.SECRET,

  session: {
    // Use JSON Web Tokens for session instead of database sessions.
    // This option can be used with or without a database for users/accounts.
    // Note: `jwt` is automatically set to `true` if no database is specified.
    jwt: true,

    // Seconds - How long until an idle session expires and is no longer valid.
    maxAge: maxAge, // 30 days

    // Seconds - Throttle how frequently to write to database to extend a session.
    // Use it to limit write operations. Set to 0 to always update the database.
    // Note: This option is ignored if using JSON Web Tokens
    // updateAge: 24 * 60 * 60, // 24 hours
  },

  // JSON Web tokens are only used for sessions if the `jwt: true` session
  // option is set - or by default if no database is specified.
  // https://next-auth.js.org/configuration/options#jwt
  jwt: {
    // A secret to use for key generation (you should set this explicitly)
    // secret: 'INp8IvdIyeMcoGAgFGoA61DdBglwwSqnXJZkgz8PSnw',
    // Set to true to use encryption (default: false)
    // encryption: true,
    // You can define your own encode/decode functions for signing and encryption
    // if you want to override the default behaviour.
    // encode: async ({ secret, token, maxAge }) => {},
    // decode: async ({ secret, token, maxAge }) => {},
    // A secret to use for key generation (you should set this explicitly)
    secret: process.env.JWT_PRIVATE_KEY,
    // Set to true to use encryption (default: false)
    // encryption: true,
    // You can define your own encode/decode functions for signing and encryption
    // if you want to override the default behaviour.
    encode: async ({ secret, token, maxAge }) => {
      // console.log(token);
      const jwtClaims = { ...token }

      if (jwtClaims.iss === undefined) {
        jwtClaims.iss = "locationbit.com";
      }

      if (jwtClaims.jti === undefined) {
        jwtClaims.jti = uuidv4();
      }

      if (jwtClaims.exp === undefined) {
        jwtClaims.exp = Math.floor(Date.now() / 1000) + (maxAge)
      }

      const encodedToken = jwt.sign(jwtClaims, secret, { algorithm: 'ES256' });
      // console.log(secret);
      // console.log(jwtClaims);
      if (jwtClaims.userId === undefined) {
        const res = await fetch(process.env.NEXTAUTH_URL + '/api/jwt', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${encodedToken}`,
          },
        });
        const json = await res.json();

        // console.log(json);
        // console.log(json.userId);
        jwtClaims.userId = json.userId;
        jwtClaims.role = json.role;
        if (json.picture) {
          jwtClaims.picture = json.picture;
        }
        
        const encodedTokenWithUserId = jwt.sign(jwtClaims, secret, { algorithm: 'ES256' });
        return encodedTokenWithUserId;
      } else {
        return encodedToken;
      }

    },
    decode: async ({ secret, token, maxAge }) => {
      // console.log(token);
      const decodedToken = jwt.verify(token, secret, { algorithms: ['ES256'] });
      // decodedToken.accessToken = token;
      // console.log(decodedToken);
      return decodedToken;
    },
  },

  // You can define custom pages to override the built-in ones. These will be regular Next.js pages
  // so ensure that they are placed outside of the '/api' folder, e.g. signIn: '/auth/mycustom-signin'
  // The routes shown here are the default URLs that will be used when a custom
  // pages is not specified for that route.
  // https://next-auth.js.org/configuration/pages
  pages: {
    // signIn: '/auth/signin',  // Displays signin buttons
    // signOut: '/auth/signout', // Displays form with sign out button
    // error: '/auth/error', // Error code passed in query string as ?error=
    // verifyRequest: '/auth/verify-request', // Used for check email page
    // newUser: null // If set, new users will be directed here on first sign in
  },

  // Callbacks are asynchronous functions you can use to control what happens
  // when an action is performed.
  // https://next-auth.js.org/configuration/callbacks
  callbacks: {
    // async signIn(user, account, profile) { return true },
    // async redirect(url, baseUrl) { return baseUrl },
    // async session(session, user) { return session },
    // async jwt(token, user, account, profile, isNewUser) {  return token  }
    // async session(session, token) {
    //   const encodedToken = jwt.sign(token, process.env.JWT_PRIVATE_KEY, { algorithm: 'ES256' });
    //   session.id = token.id;
    //   session.token = encodedToken;
    //   return Promise.resolve(session);
    // },
    // async jwt(token, user, account, profile, isNewUser) {
    //   const isUserSignedIn = user ? true : false;
    //   // make a http call to our graphql api
    //   // store this in postgres
    //   if (isUserSignedIn) {
    //     // token.id = user.id.toString();
    //   }
    //   return Promise.resolve(token);
    // }
    session: async (session, token) => {
      if (session.userId === undefined && token.userId !== undefined) {
        session.userId = token.userId;
        session.role = token.role;
      }else{
        session = null;
      }
      return session
    }
  },

  // Events are useful for logging
  // https://next-auth.js.org/configuration/events
  events: {},

  // You can set the theme to 'light', 'dark' or use 'auto' to default to the
  // whatever prefers-color-scheme is set to in the browser. Default is 'auto'
  theme: 'light',

  // Enable debug messages in the console if you are having problems
  debug: false,
})
