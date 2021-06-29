import { useRouter } from 'next/router'

const locationId = () => {
  const router = useRouter()
  const { locationId } = router.query

  return <p>locationId: {locationId}</p>
}

export default locationId