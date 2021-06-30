import { useRouter } from 'next/router'

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
  const url = "/location/"+locationId+"/786-92";
  return {
    redirect: {
      permanent: false,
      destination: "/location/3/786-92",
    },
    props: {
      locationId: locationId
    }
  }
}


export default locationId