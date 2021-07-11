import axios from 'axios'
import slugify from 'react-slugify'
import { Country, State, City } from 'country-state-city';

const locationNotFound = () => {

  return {
    redirect: {
      permanent: false,
      destination: "/404",
    },
    props: {}
  };

}

export { locationNotFound };

export const getLocationUrl = (url, locationId, locationTitle) => {
  // console.log(url);
  return axios.get(url)
    .then(res => {
      // console.log(res);
      // console.log(res.data);

      const urlslug = slugify(
        res.data.name
        + " " +
        res.data.address
        + " " +
        res.data.city
        + " " +
        res.data.state
        + " " +
        res.data.country
      );
      // console.log(locationId);
      if (locationId == res.data.id && ((locationTitle == null) || (locationTitle != null && locationTitle != urlslug))) {
        const url = "/location/" + res.data.id + "/" + urlslug;

        // console.log(url);

        return {
          redirect: {
            permanent: false,
            destination: url,
          },
          props: {}
        };
      } else if (locationId != res.data.id) {
        return locationNotFound();
      } else {
        return {
          props: {
            location: res.data
          }
        };
      }

    }).catch(error => {
      if (error.response) {
        return locationNotFound();
        // console.log(error.response.data.error);
      }
    });
}
