import React from "react";
import { Chrono } from "react-chrono";
// @material-ui/core components
import { makeStyles } from "@material-ui/core/styles";

// core components
import GridContainer from "components/Grid/GridContainer.js";
import GridItem from "components/Grid/GridItem.js";

import styles from "styles/jss/nextjs-material-kit/pages/landingPageSections/productStyle.js";

const useStyles = makeStyles(styles);

export default function TimelineSection() {
  const classes = useStyles();
  const timelineItems = [
    {
      title: "Vision & Feasibility Analysis",
      cardTitle: "Locationbit's vision & feasibility analysis",
      cardSubtitle: "To build the global decentralized ENCYCLOPEDIA for locations data on Blockchain e.g: Wikipedia for Locations. With fair compensation to contributors",
      cardDetailedText: ""
    },
    {
      title: "Prototyping",
      cardTitle: "Locationbit prototype development",
      cardSubtitle: "To make locationbit's vision into reality, we'll start with making prototying development.",
      cardDetailedText: ""
    },
    {
      title: "Minimum viable product",
      cardTitle: "Locationbit minimum viable product",
      cardSubtitle: "With minimum viable product of locationbit, users will be able to contribute and data would be available free to access.",
      cardDetailedText: ""
    },
    {
      title: "Product development",
      cardTitle: "Locationbit product Development",
      cardSubtitle: "We'll start developing locationbit product according to the vision after suggestions and improvements from previous steps.",
      cardDetailedText: ""
    },
    {
      title: "Testing",
      cardTitle: "Locationbit product testing",
      cardSubtitle: "We'll test locationbit product test before launch.",
      cardDetailedText: ""
    },
    {
      title: "Launch",
      cardTitle: "Locationbit launch",
      cardSubtitle: "",
      cardDetailedText: ""
    },
    {
      title: "New features, scale and ongoing support",
      cardTitle: "Locationbit's new features, scale and ongoing support",
      cardSubtitle: "",
      cardDetailedText: ""
    },
  ];

  return (
    <div className={classes.section}>
      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}>Locationbit launch steps</h2>
          <h5 className={classes.description}>
          </h5>
        </GridItem>
      </GridContainer>
      <div>
        <GridContainer>
          <GridItem xs={12} sm={12} md={12}>
            <div style={{ width: "100%", height: "300px" }}>
              <Chrono items={timelineItems} mode="HORIZONTAL" cardHeight={"50px"} />
            </div>
          </GridItem>
        </GridContainer>
      </div>
    </div>
  );
}
