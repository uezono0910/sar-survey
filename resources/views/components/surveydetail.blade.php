<!-- resources/views/components/surveydetail.blade.php -->
<div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <div class="w-full bg-white rounded-lg overflow-hidden shadow-xl transform transition-all m-8 sm:mx-40">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">アンケート項目選択</h3>
                        <div class="mt-2">
                            <form id="surveyForm">
                                @foreach ($surveyItems as $surveyItem)
                                    <div class="mb-2 flex items-center">
                                        <label class="inline-flex items-center mr-2">
                                            <input type="checkbox" class="form-checkbox" name="surveyItems[]" value="{{ $surveyItem->id }}">
                                            <span class="ml-2">{{ $surveyItem->content }}</span>
                                        </label>
                                        <input type="number" name="order[{{ $surveyItem->id }}]" class="form-input w-16 ml-2" min="1" placeholder="順番" value="{{ $loop->index + 1 }}"><span class="ml-2 text-xs">※表示順</span>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button id="closeModalButton" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Close</button>
                <button id="saveSurveyItemsButton" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">OK</button>
            </div>
        </div>
    </div>
</div>
