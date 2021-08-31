import React, { useEffect, useRef, useState, useCallback, useReducer } from 'react';
import { useSelector, useDispatch } from 'react-redux'
import Router from 'next/router'
import validator from 'validator';
import { phone } from 'phone';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import dynamic from 'next/dynamic';

const CKEditorLocation = dynamic(
  () => import('../CKEditor/CKEditorLocation'),
  { ssr: false }
);

// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import Slide from "@material-ui/core/Slide";
import IconButton from "@material-ui/core/IconButton";
import Dialog from "@material-ui/core/Dialog";
import DialogTitle from "@material-ui/core/DialogTitle";
import DialogContent from "@material-ui/core/DialogContent";
import DialogActions from "@material-ui/core/DialogActions";
import InputLabel from "@material-ui/core/InputLabel";
import FormControl from "@material-ui/core/FormControl";
import Tooltip from "@material-ui/core/Tooltip";
import Popover from "@material-ui/core/Popover";
// @material-ui/icons
import LibraryBooks from "@material-ui/icons/LibraryBooks";
import Close from "@material-ui/icons/Close";
// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";
import Button from "components/CustomButtons/Button.js";

import CustomInput from "components/CustomInput/CustomInput.js";
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';

import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/javascriptStyles.js";
import { ucfirst, getPhoneWithoutCountryCode, getPhoneCountryIso2Code } from './../../utility/FunctionsService';
import axios from 'axios';
import AutocompleteCountryPhone from './../Autocomplete/AutocompleteCountryPhone';

import { validatePhoneE164 } from '../../utility/LocationValidationService';
import sanitizeHtml from 'sanitize-html';
import Loading from '../Loading/Loading';
import LocationClassificationSector from './LocationClassification/LocationClassificationSector';
import LocationModalContext from './../../store/LocationModalContext';
import LocationHoursPicker from './LocationHoursPicker';
import LocationModalHoursContext from './../../store/LocationModalHoursContext';

const useStyles = makeStyles(styles);

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="down" ref={ref} {...props} />;
});

Transition.displayName = "Transition";

const naicsReducer = (state, action) => {
  switch (action.type) {
    case 'SECTOR':
      return {
        sector: action.value,
        subSector: '',
        industryGroup: '',
        naicsIndustry: '',
        nationalIndustry: ''
      }
      break;

    case 'SUBSECTOR':
      return {
        sector: state.sector,
        subSector: action.value,
        industryGroup: '',
        naicsIndustry: '',
        nationalIndustry: ''
      }
      break;

    case 'INDUSTRYGROUP':
      return {
        sector: state.sector,
        subSector: state.subSector,
        industryGroup: action.value,
        naicsIndustry: '',
        nationalIndustry: ''
      }
      break;

    case 'NAICSINDUSTRY':
      return {
        sector: state.sector,
        subSector: state.subSector,
        industryGroup: state.industryGroup,
        naicsIndustry: action.value,
        nationalIndustry: ''
      }
      break;

    case 'NATIONALINDUSTRY':
      return {
        sector: state.sector,
        subSector: state.subSector,
        industryGroup: state.industryGroup,
        naicsIndustry: state.naicsIndustry,
        nationalIndustry: action.value
      }
      break;

    default:
      break;
  }

  return {
    sector: '',
    subSector: '',
    industryGroup: '',
    naicsIndustry: '',
    nationalIndustry: ''
  };
};

const hoursReducer = (state, action) => {
  switch (action.type) {
    case 'MONDAY_FROM':
      return {
        monday: { from: action.value, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'MONDAY_TO':
      return {
        monday: { from: state.monday.from, to: action.value },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'TUESDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: action.value, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'TUESDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: action.value },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'WEDNESDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: action.value, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'WEDNESDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: action.value },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'THURSDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: action.value, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'THURSDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: action.value },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'FRIDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: action.value, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'FRIDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: action.value },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'SATURDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: action.value, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'SATURDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: action.value },
        sunday: { from: state.sunday.from, to: state.sunday.to },
      }
      break;
    case 'SUNDAY_FROM':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: action.value, to: state.sunday.to },
      }
      break;
    case 'SUNDAY_TO':
      return {
        monday: { from: state.monday.from, to: state.monday.to },
        tuesday: { from: state.tuesday.from, to: state.tuesday.to },
        wednesday: { from: state.wednesday.from, to: state.wednesday.to },
        thursday: { from: state.thursday.from, to: state.thursday.to },
        friday: { from: state.friday.from, to: state.friday.to },
        saturday: { from: state.saturday.from, to: state.saturday.to },
        sunday: { from: state.sunday.from, to: action.value },
      }
      break;

    default:
      break;
  }

  return {
    monday: { from: null, to: null },
    tuesday: { from: null, to: null },
    wednesday: { from: null, to: null },
    thursday: { from: null, to: null },
    friday: { from: null, to: null },
    saturday: { from: null, to: null },
    sunday: { from: null, to: null },
  };
};

const LocationModal = props => {

  const classes = useStyles();
  const [classicModal, setClassicModal] = React.useState(false);
  const [loadingModal, setLoadingModal] = React.useState(false);
  const [locationDescription, setLocationDescription] = useState(null);
  const inputRef = useRef('');
  const inputRefAutocomplete = useRef('');
  const location = useSelector((state) => state.location);
  const [naicsState, dispatchNaics] = useReducer(naicsReducer, {
    sector: location.sector,
    subSector: location.subSector,
    industryGroup: location.industryGroup,
    naicsIndustry: location.naicsIndustry,
    nationalIndustry: location.nationalIndustry
  });

  const [hoursState, dispatchHours] = useReducer(hoursReducer, {
    monday: location.hours && location.hours.monday ? location.hours.monday : { from: null, to: null },
    tuesday: location.hours && location.hours.tuesday ? location.hours.tuesday : { from: null, to: null },
    wednesday: location.hours && location.hours.wednesday ? location.hours.wednesday : { from: null, to: null },
    thursday: location.hours && location.hours.thursday ? location.hours.thursday : { from: null, to: null },
    friday: location.hours && location.hours.friday ? location.hours.friday : { from: null, to: null },
    saturday: location.hours && location.hours.saturday ? location.hours.saturday : { from: null, to: null },
    sunday: location.hours && location.hours.sunday ? location.hours.sunday : { from: null, to: null },
  });

  console.log(location);

  const title = props.modalTitle;
  let modalValue = props.modalValue;
  let defaultCountry = location.countrycode;

  useEffect(
    () => {
      setClassicModal(props.classicModal);
    },
    [props.classicModal],
  );

  const onNaicsChangeHandler = (obj) => {
    // dispatchNaics({type: "SECTOR", value: 786});
    console.log(naicsState);
    dispatchNaics(obj);
    console.log(naicsState);
  }

  const onHoursChangeHandler = (obj) => {
    // dispatchNaics({type: "MONDAY_FROM", value: "12:12 AM"});
    console.log(hoursState);
    dispatchHours(obj);
    console.log(hoursState);
  }

  const classicModalHandler = useCallback((value) => {
    setClassicModal(value);
    props.classicModalHandler(value);
  }, []);

  if (title == 'description') {
    // setLocationDescription(props.modalValue);
  }
  if (title == 'phone' && props.modalValue) {
    modalValue = getPhoneWithoutCountryCode(props.modalValue);
    defaultCountry = getPhoneCountryIso2Code(props.modalValue);
    console.log(defaultCountry);
  }

  const onChangeCkeditorHandler = (description) => {
    console.log("786/92");
    console.log(description);
    setLocationDescription(description);
    console.log("locationDescription" + locationDescription);
  }


  const handleSubmit = event => {
    event.preventDefault();

    console.log("called!");

    let locationUpdateData;

    if (title == 'description') {
      console.log("locationDescription2" + locationDescription);
      locationUpdateData = {
        [title]: locationDescription ? sanitizeHtml(locationDescription) : locationDescription,
      }
    } else if (title == 'classification') {
      console.log("submit classification" + naicsState);
      locationUpdateData = {
        sector: naicsState.sector,
        subSector: naicsState.subSector,
        industryGroup: naicsState.industryGroup,
        naicsIndustry: naicsState.naicsIndustry,
        nationalIndustry: naicsState.nationalIndustry
      };
    } else if (title == 'hours') {
      console.log("submit hours" + hoursState);
      locationUpdateData = {
        hours: hoursState
      };
    } else {
      if (title == 'phone') {
        const phoneValidated = validatePhoneE164(inputRefAutocomplete.current.value + inputRef.current.value)
        if (phoneValidated) {
          locationUpdateData = {
            [title]: phoneValidated,
          };
        } else {
          locationUpdateData = {
            [title]: "",
          };
        }
      } else {
        locationUpdateData = {
          [title]: inputRef.current.value,
        };
      }
    }


    console.log(locationUpdateData);
    setLoadingModal(true);
    axios.post(`/api/location/${props.locationId}/update`, locationUpdateData)
      .then(res => {
        // console.log(res);
        // console.log(res.data);
        if (res.data.success === "updated") {
          toast.success(ucfirst(title) + " updated!", {
            position: "bottom-center",
          });
          Router.reload();
        } else {
          toast.error("Oops! something went wrong... error message: " + res.data.success, {
            position: "bottom-center",
          });
          setLoadingModal(false);
        }
      }).catch(error => {
        toast.error("Oops! something went wrong...", {
          position: "bottom-center",
        });
        setLoadingModal(false);
      });
  }

  return (
    <>
      <GridContainer>
        <GridItem xs={12} sm={12} md={6} lg={4}>
          <Dialog
            classes={{
              root: classes.center,
              paper: `${classes.modal} ${classes.width100Percent}`,
            }}
            open={classicModal}
            TransitionComponent={Transition}
            keepMounted
            onClose={() => classicModalHandler(false)}
            aria-labelledby={`${title}"-classic-modal-slide-title"`}
            aria-describedby={`${title}"-classic-modal-slide-description"`}
          >
            <DialogTitle
              id={`${title}"-classic-modal-slide-title"`}
              disableTypography
              className={classes.modalHeader}
            >
              <IconButton
                className={classes.modalCloseButton}
                key="close"
                aria-label="Close"
                color="inherit"
                onClick={() => classicModalHandler(false)}
              >
                <Close className={classes.modalClose} />
              </IconButton>
              <h4 className={classes.modalTitle}>{ucfirst(title)}</h4>
            </DialogTitle>
            <DialogContent
              id={`${title}"-classic-modal-slide-description"`}
              className={classes.modalBody}
            >
              <div>
                {title == "phone" && <AutocompleteCountryPhone defaultCountry={defaultCountry} ref={inputRefAutocomplete} />}
                {title == "description" && <CKEditorLocation onChange={onChangeCkeditorHandler.bind(this)} value={props.modalValue} />}
                {(title != "description" && title != "classification" && title != "hours") && <CustomInput
                  labelText={title}
                  variant="outlined"
                  id={`"customInput-"${title}`}
                  formControlProps={{
                    fullWidth: true,
                  }}
                  inputProps={{
                    name: title,
                    id: title,
                    defaultValue: modalValue,
                    required: true,
                  }}
                  ref={inputRef}
                />}
                <LocationModalContext.Provider value={{
                  sector: naicsState.sector,
                  subSector: naicsState.subSector,
                  industryGroup: naicsState.industryGroup,
                  naicsIndustry: naicsState.naicsIndustry,
                  nationalIndustry: naicsState.nationalIndustry,
                  onNaicsChange: onNaicsChangeHandler
                }}>
                  {title == "classification" && <LocationClassificationSector sector={props.sector} />}
                </LocationModalContext.Provider>
                <LocationModalHoursContext.Provider value={{
                  monday: hoursState.monday,
                  tuesday: hoursState.tuesday,
                  wednesday: hoursState.wednesday,
                  thursday: hoursState.thursday,
                  friday: hoursState.friday,
                  saturday: hoursState.saturday,
                  sunday: hoursState.sunday,
                  onHoursChange: onHoursChangeHandler
                }}>
                  {title == "hours" && <LocationHoursPicker></LocationHoursPicker>}
                </LocationModalHoursContext.Provider>
              </div>
            </DialogContent>
            <DialogActions className={classes.modalFooter}>
              <Button variant="outlined" color="success" simple
                onClick={handleSubmit}
              >
                Save
              </Button>
              <Button
                variant="outlined"
                onClick={() => classicModalHandler(false)}
                color="danger"
                simple
              >
                Close
              </Button>
            </DialogActions>
            <ToastContainer />
          </Dialog>
        </GridItem>
      </GridContainer>
      <Loading loadingModal={loadingModal} />
    </>
  );
}

export default React.memo(LocationModal);;
