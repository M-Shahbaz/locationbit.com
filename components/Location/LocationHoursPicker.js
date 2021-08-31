import React, { useState, useContext } from "react";
import green from "@material-ui/core/colors/green";
import { createMuiTheme } from "@material-ui/core";
import { ThemeProvider } from "@material-ui/styles";
import DateFnsUtils from '@date-io/date-fns';
import { MuiPickersUtilsProvider, KeyboardTimePicker } from "@material-ui/pickers";
import TableContainer from '@material-ui/core/TableContainer';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import LocationModalHoursContext from './../../store/LocationModalHoursContext';

const defaultMaterialTheme = createMuiTheme({
  palette: {
    primary: green,
  },
});


const LocationHoursPicker = props => {
  const ctx = useContext(LocationModalHoursContext);
  console.log(ctx);
  const getTimeDateFormat = (t) => {
    const d = new Date();
    var arr = t.split(":");
    d.setHours(arr[0]);
    d.setMinutes(arr[1]);
    return d;
  }
  const getTimeValue = (date) => {
    let currentHours = date.getHours();
    currentHours = ("0" + currentHours).slice(-2);
    let currentMinutes = date.getMinutes();
    currentMinutes = ("0" + currentMinutes).slice(-2);
    return currentHours+":"+currentMinutes;
  }

  return (
    <TableContainer component={Paper}>
      <Table>
        <TableBody>
          <TableRow>
            <TableCell>
              Monday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.monday && ctx.monday.from ? getTimeDateFormat(ctx.monday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'MONDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.monday && ctx.monday.to ? getTimeDateFormat( ctx.monday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'MONDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Tuesday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.tuesday && ctx.tuesday.from ? getTimeDateFormat( ctx.tuesday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'TUESDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.tuesday && ctx.tuesday.to ? getTimeDateFormat( ctx.tuesday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'TUESDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Wednesday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.wednesday && ctx.wednesday.from ? getTimeDateFormat( ctx.wednesday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'WEDNESDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.wednesday && ctx.wednesday.to ? getTimeDateFormat( ctx.wednesday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'WEDNESDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Thursday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.thursday && ctx.thursday.from ? getTimeDateFormat( ctx.thursday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'THURSDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.thursday && ctx.thursday.to ? getTimeDateFormat( ctx.thursday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'THURSDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Friday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.friday && ctx.friday.from ? getTimeDateFormat( ctx.friday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'FRIDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.friday && ctx.friday.to ? getTimeDateFormat( ctx.friday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'FRIDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Saturday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.saturday && ctx.saturday.from ? getTimeDateFormat( ctx.saturday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'SATURDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.saturday && ctx.saturday.to ? getTimeDateFormat( ctx.saturday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'SATURDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
          <TableRow>
            <TableCell>
              Sunday
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="from"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.sunday && ctx.sunday.from ? getTimeDateFormat( ctx.sunday.from) : null}
                    onChange={date => ctx.onHoursChange({type:'SUNDAY_FROM', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
            <TableCell>
              <ThemeProvider theme={defaultMaterialTheme}>
                <MuiPickersUtilsProvider utils={DateFnsUtils}>
                  <KeyboardTimePicker
                    label="to"
                    placeholder="08:00 AM"
                    mask="__:__ _M"
                    value={ctx.sunday && ctx.sunday.to ? getTimeDateFormat( ctx.sunday.to) : null}
                    onChange={date => ctx.onHoursChange({type:'SUNDAY_TO', value: getTimeValue(date)})}
                  />
                </MuiPickersUtilsProvider>
              </ThemeProvider>
            </TableCell>
          </TableRow>         
        </TableBody>
      </Table>
    </TableContainer>

  );
};

export default LocationHoursPicker;
