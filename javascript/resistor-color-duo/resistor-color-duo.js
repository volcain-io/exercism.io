export const decodedValue = (arg) => {
  const colors = ["black", "brown", "red", "orange", "yellow", "green", "blue", "violet", "grey", "white"];

  return parseInt(arg.slice(0,2).map(elem => colors.indexOf(elem) ).join(''));
};
