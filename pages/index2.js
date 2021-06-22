import Layout from '../components/layout'
import { signIn } from "next-auth/client"
import Button from '@material-ui/core/Button';


export default function Page () {
  return (
    <Layout>
      <h1>NextAuth.js Example</h1>
      <p>
      <Button variant="contained" onClick={() => signIn("google")} color="primary">Sign in with Google</Button>
        This is an example site to demonstrate how to use <a href={`https://next-auth.js.org`}>NextAuth.js</a> for authentication.
      </p>
    </Layout>
  )
}