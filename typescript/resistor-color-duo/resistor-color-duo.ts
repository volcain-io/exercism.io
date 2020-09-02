const bandColors = {
    black: 0,
    brown: 1,
    red: 2,
    orange: 3,
    yellow: 4,
    green: 5,
    blue: 6,
    violet: 7,
    grey: 8,
    white: 9,
};
type Color = keyof typeof bandColors;
type ColorPair = [Color, Color, ...Color[]];

export class ResistorColor {
    private _first: Color;
    private _second: Color;

    constructor(colors: ColorPair) {
        [this._first, this._second] = colors;
    }

    value = (): number => {
      return bandColors[this._first] * 10 + bandColors[this._second];
    }
}
