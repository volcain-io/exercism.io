export const colorCode = (name = "") => {
  return COLORS.indexOf(name && name.trim().toLowerCase());
};
 
export const COLORS = [
  "black",
  "brown",
  "red",
  "orange",
  "yellow",
  "green",
  "blue",
  "violet",
  "grey",
  "white"
];
