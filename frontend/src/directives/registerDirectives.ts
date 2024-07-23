import { createApp } from "vue";
import maxLength from "./maxLength";
import scrollReveal from "./scrollReveal";
import maxNumericValue from "./maxNumericValue";
import maxLetters from "./maxLetters";

export default function(app: ReturnType<typeof createApp>) {
    return app
        .directive('scroll-reveal', scrollReveal)             
        .directive('max-length', maxLength)
        .directive('max-letters', maxLetters)
        .directive('max-numeric-value', maxNumericValue)
}