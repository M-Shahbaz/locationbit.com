import React, { useState, useCallback } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { signIn, signOut, useSession, getSession } from 'next-auth/client';

import { Country, State, City } from 'country-state-city';
import GridItem from "components/Grid/GridItem.js";
import GridContainer from "components/Grid/GridContainer.js";
import EditLocationIcon from '@material-ui/icons/EditLocation';
import EditIcon from '@material-ui/icons/Edit';
import TableContainer from '@material-ui/core/TableContainer';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import CheckCircleIcon from '@material-ui/icons/CheckCircle';
import CancelIcon from '@material-ui/icons/Cancel';
//import { withStyles } from "@material-ui/core/styles";
import { makeStyles } from "@material-ui/core/styles";
import CustomInput from "components/CustomInput/CustomInput.js";
import styles from './../../styles/jss/Location/LocationTableRowStyle';
import LocationModal from './LocationModal';
import { ucfirst } from './../../utility/FunctionsService';
import classesModule from './LocationTableRow.module.css';
import sanitizeHtml from 'sanitize-html';
import { time24to12Convert, truncate, camelToTitle } from './../../utility/FunctionsService';
// @ts-ignore
import naics from "naics";


const useStyles = makeStyles(styles);


const LocationTableRow = props => {
  const classes = useStyles();
  const [session, loading] = useSession();
  // const { classes } = props;
  const [inputClass, setInputClass] = useState(classes.hide);
  const [valueClass, setValueClass] = useState(classes.showInlineBlock);
  const [editIconClass, setEditIconClass] = useState(classes.hide);
  const [classicModal, setClassicModal] = useState(false);
  const location = useSelector((state) => state.location);

  const sectorIndustry = naics.Industry.from(location.sector);
  const subSectorIndustry = naics.Industry.from(location.subSector);
  const industryGroupIndustry = naics.Industry.from(location.industryGroup);
  const naicsIndustryIndustry = naics.Industry.from(location.naicsIndustry);
  const nationalIndustryIndustry = naics.Industry.from(location.nationalIndustry);

  const timezones = Country.getCountryByCode(location.countrycode).timezones;
  console.log(timezones);

  const trimmedTableRowValue = (props.tableRowName != 'address' && props.tableRowValue) ? truncate(props.tableRowValue, 40) : props.tableRowValue;

  const classicModalHandler = useCallback((value) => {
    console.log(value);
    setClassicModal(value);
  }, [])

  const preventDefault = useCallback((e) => {
    e.preventDefault();
  }, [])

  const onMouseEnterHandler = useCallback((e) => {
    if (props.edit)
      setEditIconClass(classes.showInlineBlock);
  }, [])

  const onMouseLeaveHandler = useCallback((e) => {
    if (props.edit)
      setEditIconClass(classes.hide);
  }, [])

  const onClickHandler = useCallback((e) => {
    if (props.edit) {
      setClassicModal(true);
    }
  }, []);

  let showRow = true;
  if(!session){
    showRow = props.tableRowValue ? true : null;
  }
  

  return (
    <>
    {showRow && <TableRow>
      <TableCell>{camelToTitle(props.tableRowName)}:</TableCell>
      <TableCell>
        {<div className={`${props.edit && classes.cursorPointer} ${valueClass} ${classesModule.width100}`}
          onMouseEnter={onMouseEnterHandler}
          onMouseLeave={onMouseLeaveHandler}
          onClick={onClickHandler}>
          {(props.tableRowName == 'description' && props.tableRowValue) && <div dangerouslySetInnerHTML={{ __html: sanitizeHtml(props.tableRowValue).replace(/(<? *script)/gi, 'illegalscript') }} ></div>}
          {(props.tableRowName == 'timezones') &&
            <TableContainer component={Paper}>
              <Table>
                <TableBody>
                  {timezones.map((tz) => (
                    <TableRow key={tz.gmtOffset}>
                      <TableCell>
                        {tz.zoneName}
                      </TableCell>
                      <TableCell>
                        {tz.gmtOffsetName}
                      </TableCell>
                      <TableCell>
                        {tz.abbreviation}
                      </TableCell>
                      <TableCell>
                        {tz.tzName}
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </TableContainer>
          }
          {(props.tableRowName == 'classification' && props.tableRowValue) &&
            <TableContainer component={Paper}>
              <Table>
                <TableBody>
                  {sectorIndustry &&
                    <TableRow>
                      <TableCell>
                        {sectorIndustry && "Sector: "}{sectorIndustry && sectorIndustry.title}
                      </TableCell>
                    </TableRow>
                  }
                  {subSectorIndustry &&
                    <TableRow>
                      <TableCell>
                        {subSectorIndustry && "Subsector: "}{subSectorIndustry && subSectorIndustry.title}
                      </TableCell>
                    </TableRow>
                  }
                  {industryGroupIndustry &&
                    <TableRow>
                      <TableCell>
                        {industryGroupIndustry && "Industry group: "}{industryGroupIndustry && industryGroupIndustry.title}
                      </TableCell>
                    </TableRow>
                  }
                  {naicsIndustryIndustry &&
                    <TableRow>
                      <TableCell>
                        {naicsIndustryIndustry && "Naics industry: "}{naicsIndustryIndustry && naicsIndustryIndustry.title}
                      </TableCell>
                    </TableRow>
                  }
                  {nationalIndustryIndustry &&
                    <TableRow>
                      <TableCell>
                        {nationalIndustryIndustry && "National industry: "}{nationalIndustryIndustry && nationalIndustryIndustry.title}
                      </TableCell>
                    </TableRow>
                  }
                </TableBody>
              </Table>
            </TableContainer>}
          {(props.tableRowName == 'hours' && props.tableRowValue) &&
            <TableContainer component={Paper}>
              <Table>
                <TableBody>
                  {location.hours.monday && location.hours.monday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.monday.from && "Monday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.monday.from && time24to12Convert(location.hours.monday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.monday.to && time24to12Convert(location.hours.monday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.tuesday && location.hours.tuesday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.tuesday.from && "Tuesday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.tuesday.from && time24to12Convert(location.hours.tuesday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.tuesday.to && time24to12Convert(location.hours.tuesday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.wednesday && location.hours.wednesday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.wednesday.from && "Wednesday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.wednesday.from && time24to12Convert(location.hours.wednesday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.wednesday.to && time24to12Convert(location.hours.wednesday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.thursday && location.hours.thursday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.thursday.from && "Thursday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.thursday.from && time24to12Convert(location.hours.thursday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.thursday.to && time24to12Convert(location.hours.thursday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.friday && location.hours.friday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.friday.from && "Friday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.friday.from && time24to12Convert(location.hours.friday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.friday.to && time24to12Convert(location.hours.friday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.saturday && location.hours.saturday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.saturday.from && "Saturday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.saturday.from && time24to12Convert(location.hours.saturday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.saturday.to && time24to12Convert(location.hours.saturday.to)}
                      </TableCell>
                    </TableRow>
                  }
                  {location.hours.sunday && location.hours.sunday.from &&
                    <TableRow>
                      <TableCell>
                        {location.hours.sunday.from && "Sunday: "}
                      </TableCell>
                      <TableCell>
                        {location.hours.sunday.from && time24to12Convert(location.hours.sunday.from)}
                      </TableCell>
                      <TableCell>
                        {location.hours.sunday.to && time24to12Convert(location.hours.sunday.to)}
                      </TableCell>
                    </TableRow>
                  }

                </TableBody>
              </Table>
            </TableContainer>}
          {(props.tableRowName == 'description' || props.tableRowName == 'classification' || props.tableRowName == 'timezones'|| props.tableRowName == 'hours') ? null : trimmedTableRowValue}
          {!props.tableRowValue && <a href="#" onClick={preventDefault}>Add {props.tableRowName}</a>}
          <a href="#" onClick={preventDefault} className={editIconClass} >{props.edit && <EditLocationIcon fontSize="inherit" />}</a>
        </div>}
        {props.edit && <LocationModal
          locationId={props.locationId}
          classicModal={classicModal}
          classicModalHandler={classicModalHandler.bind(this)}
          modalTitle={props.tableRowName}
          modalValue={props.tableRowValue}
        />
        }
      </TableCell>
    </TableRow>}
    </>
  );
}

// export default withStyles(styles)(LocationTableRow)
export default React.memo(LocationTableRow);
