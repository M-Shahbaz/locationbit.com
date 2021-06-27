import React, { useEffect, useRef, useState } from "react";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// @material-ui/icons
import VerifiedUser from "@material-ui/icons/VerifiedUser";
import AddLocationIcon from '@material-ui/icons/AddLocation';
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import InfoArea from "components/InfoArea/InfoArea.js";
import CustomInput from "components/CustomInput/CustomInput.js";
import Button from "components/CustomButtons/Button.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";
import AutocompleteCountry from "../../components/Autocomplete/AutocompleteCountry";
import AutocompleteState from "../../components/Autocomplete/AutocompleteState";
import AutocompleteCity from "../../components/Autocomplete/AutocompleteCity";
import axios from "axios";

const useStyles = makeStyles(styles);

export default function LocationAddSection() {
  const classes = useStyles();
  const [selectedCountryCode, setSelectedCountryCode] = useState(null);
  const [selectedState, setSelectedState] = useState(null);
  const [selectedCity, setSelectedCity] = useState(null);

  const nameRef = useRef('');
  const addressRef = useRef('');
  const zipcodeRef = useRef('');
  // useEffect(() => {

  // }, selectedCountryCode);

  const countryHandler = (countryCode) => {
    console.log("786/92");
    console.log(countryCode);
    setSelectedCountryCode(countryCode);
  };

  const stateHandler = (state) => {
    console.log("state");
    console.log(state);
    setSelectedState(state);
  };

  const cityHandler = (city) => {
    console.log("city");
    console.log(city);
    setSelectedCity(city);
  };


  const handleSubmit = event => {
    event.preventDefault();
    
    const locationCreateData = {
      name: nameRef.current.value,
      address: addressRef.current.value,
      zipcode: zipcodeRef.current.value,
      country: selectedCountryCode,
      state: selectedState.name,
      city: selectedCity.name,
      cityObject: selectedCity,
    };

    console.log(locationCreateData);

    axios.post(`/api/location/add`, locationCreateData)
      .then(res => {
        console.log(res);
        console.log(res.data);
      });
  }

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}><AddLocationIcon /> Add location</h2>
          <h5 className={classes.description}>
            Add a location to get tickets and shares to get a chance to earn money and prizes.
          </h5>
        </GridItem>
      </GridContainer>
      <div>
        <GridContainer>
          <GridItem xs={12} sm={12} md={6}>
            <form onSubmit={handleSubmit}>
              <GridContainer>
                <GridItem xs={12} sm={12} md={12}>
                  <AutocompleteCountry onChangeCountryHandler={countryHandler} />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <AutocompleteState onChangeStateHandler={stateHandler} countryCode={selectedCountryCode} />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <AutocompleteCity onChangeCityHandler={cityHandler} countryCode={selectedCountryCode} stateCode={selectedState ? selectedState.isoCode : null } />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location name"
                    id="name"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                    inputProps={{
                      required: true,
                    }}
                    ref={nameRef}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location address"
                    id="address"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                    inputProps={{
                      required: true,
                    }}
                    ref={addressRef}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12}>
                  <CustomInput
                    labelText="Location zipcode"
                    id="zipcode"
                    success
                    formControlProps={{
                      fullWidth: true,
                    }}
                    inputProps={{
                      required: true,
                    }}
                    ref={zipcodeRef}
                  />
                </GridItem>
                <GridItem xs={12} sm={12} md={12} className={classes.textCenter}>
                  <Button color="success" type="submit" fullWidth><AddLocationIcon /> Submit</Button>
                </GridItem>
              </GridContainer>
            </form>
          </GridItem>
          <GridItem xs={12} sm={12} md={6}>
            <InfoArea
              title="Verified Users"
              description="Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough."
              icon={VerifiedUser}
              iconColor="success"
              vertical
            />
          </GridItem>
        </GridContainer>
      </div>
    </div>
  );
}
