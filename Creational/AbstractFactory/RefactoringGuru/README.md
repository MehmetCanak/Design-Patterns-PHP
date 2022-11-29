
![alt text](https://refactoring.guru/images/patterns/cards/abstract-factory-mini.png?id=4c3927c446313a38ce77dfee38111e27 "Abstract Factory") Abstract Factory in PHP

**Soyut Fabrika, somut sınıflarını belirtmeden tüm ürün ailelerini yaratma problemini çözen yaratıcı bir tasarım modelidir.**

Soyut Fabrika, tüm farklı ürünleri oluşturmak için bir arayüz tanımlar, ancak asıl ürün oluşturmayı somut fabrika sınıflarına bırakır. Her fabrika tipi belirli bir ürün çeşidine karşılık gelmektedir. Bu, ürünlerin birbirinden bağımsız olarak geliştirilmesini ve değiştirilmesini sağlar.

İstemci kodu, doğrudan bir yapıcı çağrısıyla (new operator) ürünler oluşturmak yerine bir fabrika nesnesinin oluşturma yöntemlerini çağırır. Bir fabrika, tek bir ürün varyantına karşılık geldiğinden, tüm ürünleri uyumlu olacaktır.

İstemci kodu, fabrikalar ve ürünlerle yalnızca soyut arayüzleri aracılığıyla çalışır. Bu, müşteri kodunun fabrika nesnesi tarafından oluşturulan herhangi bir ürün çeşidiyle çalışmasını sağlar. Siz sadece yeni bir somut fabrika sınıfı yaratın ve bunu müşteri koduna iletin.

### Kullanım örnekleri: 
- Soyut Fabrika modeli, PHP kodunda oldukça yaygındır. Birçok çerçeve ve kitaplık, standart bileşenlerini genişletmenin ve özelleştirmenin bir yolunu sağlamak için bunu kullanır. 

### Tanımlama: 
-Modelin, bir fabrika nesnesi döndüren yöntemlerle tanınması kolaydır. Ardından fabrika, belirli alt bileşenleri oluşturmak için kullanılır.


### Kavramsal Örnek 
Bu örnek, Soyut Fabrika tasarım modelinin yapısını göstermektedir. 

Şu soruları cevaplamaya odaklanır: 

- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? 
- Modelin öğeleri nasıl ilişkilidir? 

Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan aşağıdaki örneği kavramanız daha kolay olacaktır.

### Gerçek Dünya Örneği 

Bu örnekte, Soyut Fabrika modeli, bir web sayfasının farklı öğeleri için çeşitli şablon türleri oluşturmak için bir altyapı sağlar.

Bir web uygulaması, farklı işleme motorlarını aynı anda destekleyebilir, ancak yalnızca sınıfları, işleme motorlarının somut sınıflarından bağımsızsa. Bu nedenle, uygulamanın nesneleri şablon nesnelerle yalnızca soyut arayüzleri aracılığıyla iletişim kurmalıdır. Kodunuz doğrudan şablon nesneleri oluşturmamalı, ancak bunların oluşturulmasını özel fabrika nesnelerine devretmelidir. Son olarak, kodunuz da fabrika nesnelerine bağlı olmamalı, bunun yerine soyut fabrika arayüzü aracılığıyla onlarla birlikte çalışmalıdır.

Sonuç olarak, uygulamaya işleme motorlarından birine karşılık gelen fabrika nesnesini sağlayabileceksiniz. Uygulamada oluşturulan tüm şablonlar o fabrika tarafından oluşturulacak ve türleri fabrikanın türüyle eşleşecektir. Oluşturma motorunu değiştirmeye karar verirseniz, mevcut herhangi bir kodu bozmadan müşteri koduna yeni bir fabrika geçirebileceksiniz.
