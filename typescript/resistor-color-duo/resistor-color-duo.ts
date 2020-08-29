type Color = "black" | "brown" | "red" | "orange" | "yellow" | "green" | "blue" | "violet" | "grey" | "white";

export class ResistorColor {
    private colors: Color[];
    private bandColors: Color[];

    constructor(colors: Color[]) {
        if (colors.length < 2) {
            throw new Error("At least two colors need to be present");
        }
        this.colors = colors;
        this.bandColors = [
            "black",
            "brown",
            "red",
            "orange",
            "yellow",
            "green",
            "blue",
            "violet",
            "grey",
            "white",
        ];
    }

    value = (): number =>
        Number(
            this.colors
                .slice(0, 2)
                .map((color) => this.bandColors.indexOf(color))
                .join("")
        );
}
