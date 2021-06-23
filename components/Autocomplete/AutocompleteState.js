import React from 'react';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';
import { makeStyles } from '@material-ui/core/styles';
import { Country, State, City } from 'country-state-city';


const useStyles = makeStyles({
  option: {
    fontSize: 15,
    '& > span': {
      marginRight: 10,
      fontSize: 18,
    },
    // Hover with light-grey
    '&[data-focus="true"]': {
      backgroundColor: '#4caf50',
      borderColor: 'transparent',
    },
    // Selectedhas dark-grey
    '&[aria-selected="true"]': {
      backgroundColor: '#4caf50',
      borderColor: 'transparent',
    },
    '&[aria-selected="true"]': {
      backgroundColor: '#4caf50',
      borderColor: 'transparent',
    },
  },
  inputLabel: {
    color: '#4caf50 !important',
    fontWeight: "400",
    fontSize: "14px",
  },
  inputRoot: {
    "&.MuiInput-underline:after": {
      borderColor: "#4caf50"
    }
  }
});

const AutocompleteState = props => {
  const classes = useStyles();
  const states = State.getStatesOfCountry(props.countryCode);

  const stateChangeHandler = (event, value) => {
    if(value){
      console.log(value);
      props.onChangeStateHandler(value.isoCode);
    }else{
      props.onChangeStateHandler(null);
    }
    
    
  };


  return (
    <Autocomplete
      id="state"
      style={{ width: "100%", marginBottom: "17px" }}
      options={states}
      classes={{
        option: classes.option,
        inputRoot: classes.inputRoot,
      }}
      autoHighlight
      getOptionLabel={(option) => option.name}
      renderOption={(option) => (
        <React.Fragment>
          {option.name} ({option.isoCode})
        </React.Fragment>
      )}
      renderInput={(params) => (
        <TextField
          {...params}
          InputLabelProps={{ className: classes.inputLabel }}
          label="Location state"
          inputProps={{
            ...params.inputProps,
            autoComplete: 'new-password', // disable autocomplete and autofill
          }}
        />
      )}
      onChange={stateChangeHandler}
    />
  );
};

export default AutocompleteState;
