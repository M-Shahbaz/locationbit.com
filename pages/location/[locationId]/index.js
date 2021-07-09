import { useRouter } from 'next/router'
// This is an example of to protect an API route
import { getSession } from 'next-auth/client'
import { getLocationUrl } from 'utility/LocationService.js';

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
  return await getLocationUrl('/api/server/location/' + locationId, locationId, null).then( response => {
    return response;
  });    
}


export default locationId