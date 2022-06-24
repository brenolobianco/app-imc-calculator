function snapCrackle(maxValue) {
    let ArrRetorno = []
    for (let counter = 1; counter <= maxValue; counter++) {

        if (counter % 2 == 1 && counter % 5 == 0) {

            ArrRetorno.push(" SnapCrackle")
        } else if (counter % 5 == 0) {

            ArrRetorno.push(" Crackle")

        } else if (counter % 2 == 1) {

            ArrRetorno.push(" Snap")

        } else {

            ArrRetorno.push(" " + counter)
        }
    }

    return ArrRetorno.join(",")
}
console.log(snapCrackle(15))


function snapCracklePrime(maxValue) {
    let ArrRetorno = []
  
    //Funçao que verifica se o numero é primo retornando boolean
    function Primo(n) {
        if (n < 2) {
            return false;
        }
        for (let divisor = n - 1; divisor >= 2; divisor--) {
            let resto = n % divisor;
            if ((resto) == 0) {
                return false;
            }
        }
        return true;
    }

    for (let counter = 1; counter <= maxValue; counter++) {

        let EhPrimo = Primo(counter)

        if (counter % 2 == 1 && counter % 5 == 0 && EhPrimo == true) {

            ArrRetorno.push(" SnapCracklePrime")

        } else if (counter % 5 == 0 && EhPrimo == true) {

            ArrRetorno.push(" CracklePrime")

        } else if (counter % 2 == 1 && EhPrimo == true) {

            ArrRetorno.push(" SnapPrime")

        } else if (counter % 2 == 1 && counter % 5 == 0) {

            ArrRetorno.push(" SnapCrackle")

        } else if (counter % 5 == 0) {

            ArrRetorno.push(" Crackle")

        } else if (counter % 2 == 1) {

            ArrRetorno.push(" Snap")

        } else if (EhPrimo == true)

            ArrRetorno.push(" Prime")

        else {

            ArrRetorno.push(" " + counter)
        }
    }
    return ArrRetorno.join(",")
}
console.log(snapCracklePrime(15))