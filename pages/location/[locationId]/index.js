import { useRouter } from 'next/router'
// This is an example of to protect an API route
import { getSession } from 'next-auth/client'
import axios from 'axios'
import slugify from 'react-slugify'

const locationId = (props) => {
  const router = useRouter()
  // const { locationId } = router.query

  return <p>locationId: {props.locationId}</p>
}


export async function getServerSideProps(context) {
  const req = context.req;
  const res = context.res;
  const { params } = context;
  const locationId = params.locationId;
  // fetch data from an api
  const session = await getSession({ req });

  let location = {};

  function getLocation(url, jwt) {

    const AuthStr = 'Bearer '.concat(jwt);
    return axios.get(url, { headers: { Authorization: AuthStr } })
      .then(res => {
        // console.log(res);
        // console.log(res.data);
        return res.data;
      });
  }

  if (session) {
    const cookies = req.cookies;
    const jwt = cookies['next-auth.session-token'];

    const sessionLocation = async () => {
      location = await getLocation('/api/location/' + locationId, jwt);
      console.log(location);

      const urlslug = slugify(
        location.name
        + " " +
        location.address
        + " " +
        location.city
        + " " +
        location.country
      );

      const url = "/location/" + location.id + "/" + urlslug;

      console.log(url);

      return {
        redirect: {
          permanent: false,
          destination: url,
        },
        props: {
          locationId: locationId
        }
      }
    };
    return sessionLocation();

  } else {
    
    const publicLocation = async () => {
      location = await getLocation('/api/public/location/' + locationId, null);
      console.log(location);
      const urlslug = slugify(
        location.name
        + " " +
        location.address
        + " " +
        location.city
        + " " +
        location.country
      );

      const url = "/location/" + location.id + "/" + urlslug;

      console.log(url);

      return {
        redirect: {
          permanent: false,
          destination: url,
        },
        props: {
          locationId: locationId
        }
      }
    };
    return publicLocation();
  }

}


export default locationId