<x-app-layout>
    <!--Left Col-->
    <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
        <h1 class="page-title slide-in-bottom-h1">
            Voor iedere order een verzending
        </h1>
        <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
            Maak hier voor al je orders een verzending aan, en ontvang een pakbon met verzendlabel!
        </p>

        <p class="text-orange-500 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">Ga gelijk aan de slag:</p>
        <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in">
            <a class="btn btn-primary mr-3" href="{{ route('shipment.create') }}">
                Maak een verzendlabel aan
            </a>
            <a class="btn btn-primary">
                Bekijk verzendlabels
            </a>
        </div>
    </div>

    <!--Right Col-->
    <div class="flex flex-col w-full xl:w-2/5 justify-center overflow-y-hidden lg:items-center lg:pt-6">
       <img src="../../images/bg.svg" alt="Shipping packages">
    </div>
</x-app-layout>
