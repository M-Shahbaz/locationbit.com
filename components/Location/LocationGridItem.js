import React from 'react';
import GridItem from "components/Grid/GridItem.js";
import GridContainer from "components/Grid/GridContainer.js";

const LocationGridItem = props => {
  return (
    <GridItem xs={12} sm={12} md={12} className={props.classes.textLeft}>
      <GridContainer>
        <GridItem xs={4} sm={4} md={3}>
          <p className={props.classes.description}>{props.gridItemName}:</p>
        </GridItem>
        <GridItem xs={8} sm={8} md={9}>
          <p className={props.classes.description}>
            {props.gridItemValue}
          </p>
        </GridItem>
      </GridContainer>
    </GridItem>
  );
};

export default LocationGridItem;
