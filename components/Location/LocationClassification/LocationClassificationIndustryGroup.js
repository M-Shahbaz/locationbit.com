import React, { useEffect, useContext } from 'react';
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";
import FormControlLabel from "@material-ui/core/FormControlLabel";
import FiberManualRecord from "@material-ui/icons/FiberManualRecord";
import Radio from "@material-ui/core/Radio";
import GridItem from "components/Grid/GridItem.js";
import styles from "styles/jss/nextjs-material-kit/pages/componentsSections/basicsStyle.js";
import classesCss from './LocationClassificationSector.module.css';
// @ts-ignore
import naics from "naics";
import LocationClassificationNAICSIndustry from './LocationClassificationNAICSIndustry';
import LocationModalContext from '../../../store/LocationModalContext';
const useStyles = makeStyles(styles);


const LocationClassificationIndustryGroup = props => {
  const ctx = useContext(LocationModalContext);
  const classes = useStyles();
  const [selectedEnabled, setSelectedEnabled] = React.useState(null);
  const sectors = naics.Industry.sectors();
  const sectorsArray = [...sectors];

  const industryDesc = new naics.Industry( props.subSector && props.subSector);
  const industryGroups = industryDesc.children();

  useEffect( ()=> {
    setSelectedEnabled(ctx.industryGroup);
  }, [ctx.industryGroup]);

  if(!props.subSector){
    return <></>;
  }
  return (
    <GridItem xs={12} sm={12} md={12}>
      <div className={classes.title}>
        <h3>Industry groups</h3>
      </div>
      {industryGroups.map((value, key) => {
        console.log(value._code);
        const industry = naics.Industry.from(value._code);

        console.log(industry.title); // Software Publishers
        return (
          <div
            key={key}
            className={
              classes.checkboxAndRadio +
              " " +
              classes.checkboxAndRadioHorizontal
            }
          >
            <FormControlLabel
              control={
                <Radio
                  checked={selectedEnabled === value._code}
                  onChange={() => ctx.onNaicsChange({type:'INDUSTRYGROUP', value: value._code})}
                  value={value._code}
                  name="INDUSTRYGROUP"
                  aria-label={industry.title}
                  icon={
                    <FiberManualRecord className={classes.radioUnchecked} />
                  }
                  checkedIcon={
                    <FiberManualRecord className={classes.radioChecked} />
                  }
                  classes={{
                    checked: classes.radio,
                    root: classes.radioRoot,
                  }}
                />
              }
              classes={{
                label: `${classesCss.labelColorBlack} ${classes.label}`,
                root: classes.labelRoot,
              }}
              label={industry.title}
            />
          </div>
        )
      })}
      <LocationClassificationNAICSIndustry industryGroup={selectedEnabled}/>
    </GridItem>
  );
};

export default LocationClassificationIndustryGroup;
