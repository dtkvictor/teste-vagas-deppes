export default class NumberHelper 
{
    public static random(min: number, max: number): number
    {
        return Math.random() * (max - min) + min;
    }
}