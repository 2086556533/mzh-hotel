let filter={
    //value是需要过滤的值
    capitalize(value,position){
        return value.substring(0,position).toUpperCase()+value.assign
    },
    formateTime(value){
        let date=new Date(value*1000);
        let time=[date.getFullYear(),date.getMonth()+1,date.getDate()];
        return time;
    }
}
export default filter;