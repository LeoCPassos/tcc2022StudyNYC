

$('.noSChar').on('input', function () {
    const txt = this.value;
    const txtWithoutSpace = txt.replace(/ /g, "");
    const txtWithoutSpecialChar = txtWithoutSpace.replace(/[^a-zA-Z 0-9_]+/g, "");
    this.value = txtWithoutSpecialChar;
});

$('.onlyLetterNumbers').on('input', function () {
    const txt = this.value;
    const txtWithoutSpecialChar = txt.replace(/[^a-zA-Z 0-9çÇáÁéÉíÍóÓúÚãÃõÕ]+/g, "");
    this.value = txtWithoutSpecialChar;
});

$('.noTag').on('input', function (){
    const txt = this.value;
    const txtWithoutSpecialChar = txt.replace(/<>+/g, "");
    this.value = txtWithoutSpecialChar;
});