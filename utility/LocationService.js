import axios from 'axios'
import slug from 'slug'

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

      const urlslug = slug(
        stringToSlug(
          res.data.name
          + " " +
          res.data.address
          + " " +
          res.data.city
          + " " +
          res.data.state
          + " " +
          res.data.country
        )
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
            key: res.data.id,
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

export const getLocationSearch = (url, q) => {
  // console.log(url);
  return axios.get(url, {
    data: {
      q: q
    }
  }).then(res => {
    console.log(res);
    console.log(res.data);

    return {
      props: {
        locations: res.data
      }
    };

  }).catch(error => {
    if (error.response) {
      return locationNotFound();
      // console.log(error.response.data.error);
    }
  });
}


export const getLocationSlugUrl = (locationId, location) => {

  const urlslug = slug(
    stringToSlug(
      location.name
      + " " +
      location.address
      + " " +
      location.city
      + " " +
      location.state
      + " " +
      location.country
    )
  );

  const url = "/location/" + locationId + "/" + urlslug;
  // console.log(url);
  return url;
}

const stringToSlug = (string) => {
  string = string.replace(/null/g, '""');
  return string;
}

export const getLocationCommaTrimName = (arr) => {

  let locationNameCommaTrimmed = arr.filter(x => x);
  locationNameCommaTrimmed = locationNameCommaTrimmed.join(", ");

  // console.log(locationNameCommaTrimmed);
  return locationNameCommaTrimmed;
}