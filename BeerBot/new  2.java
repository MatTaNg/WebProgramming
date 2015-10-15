     public static ArrayList<Integer> mergeSort(ArrayList<Integer> arrayList) {
        ArrayList<Integer> listLeft = new ArrayList<Integer>();
        ArrayList<Integer> listRight = new ArrayList<Integer>();
        ArrayList<Integer> result = new ArrayList<Integer>();
        if(arrayList.size() < 2)
            return arrayList;
        
        for(int i = 0; i < arrayList.size(); i++){
            if(i < arrayList.size()/2)
                listLeft.add(arrayList.get(i));
            else
                listRight.add(arrayList.get(i));
        }
        listLeft = mergeSort(listLeft);
        listRight = mergeSort(listRight);
        
        int left = 0; 
        int right = 0;
        //Go through left and right, sorting them until we reach the end.
        while(listLeft.size() != left && listRight.size() != right) {
            if(listLeft.get(left).compareTo((listRight.get(right))) == -1) {
                result.add(listLeft.get(left));
                left++;
            }
            else {
                result.add(listRight.get(right));
                right++;
            }
        }
        //Dump the rest of the list onto result
         while(listLeft.size() != left){
            result.add(listLeft.get(left));
            left++;
        }
        while(listRight.size() != right) {
            result.add(listRight.get(right));
            right++;
        }
        return result;
    }