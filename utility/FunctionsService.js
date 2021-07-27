export const ucfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    return firstLetter.toUpperCase() + str.substr(1);
}

export const plusfirst = (str) => {
    var firstLetter = str.substr(0, 1);
    if(firstLetter == "+"){
    	return str;
    }else{
        return "+" + str;
    }
}