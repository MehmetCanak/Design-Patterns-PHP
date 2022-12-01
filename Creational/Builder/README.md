# `Builder`

## Niyet 

**Builder, karmaşık nesneleri adım adım oluşturmanıza izin veren yaratıcı bir tasarım modelidir. Desen, aynı yapım kodunu kullanarak bir nesnenin farklı türlerini ve temsillerini oluşturmanıza olanak tanır.**

![alt text](https://refactoring.guru/images/patterns/content/builder/builder-en.png "Builder")

## Sorun 

Pek çok alanın ve iç içe nesnelerin zahmetli, adım adım başlatılmasını gerektiren karmaşık bir nesne düşünün. Bu tür başlatma kodu genellikle çok sayıda parametreye sahip korkunç bir kurucunun içine gömülür. Veya daha da kötüsü: müşteri kodunun her yerine dağılmış durumda.


![alt text](https://refactoring.guru/images/patterns/diagrams/builder/problem1.png "Builder")

Örneğin, bir House nesnesinin nasıl oluşturulacağını düşünelim. Basit bir ev inşa etmek için dört duvar ve bir zemin inşa etmeniz, bir kapı takmanız, bir çift pencere takmanız ve bir çatı inşa etmeniz gerekiyor. Peki ya arka bahçesi ve diğer güzellikleri (ısıtma sistemi, sıhhi tesisat ve elektrik tesisatı gibi) olan daha büyük, daha parlak bir ev istiyorsanız?

En basit çözüm, temel House sınıfını genişletmek ve parametrelerin tüm kombinasyonlarını kapsayacak bir dizi alt sınıf oluşturmaktır. Ama sonunda hatırı sayılır sayıda alt sınıfa sahip olacaksınız. Sundurma stili gibi herhangi bir yeni parametre, bu hiyerarşinin daha da büyütülmesini gerektirecektir.

Alt sınıfların üremesini içermeyen başka bir yaklaşım var. House nesnesini kontrol eden tüm olası parametrelerle doğrudan temel House sınıfında dev bir kurucu oluşturabilirsiniz. Bu yaklaşım aslında alt sınıflara olan ihtiyacı ortadan kaldırırken, başka bir sorun yaratır.

![alt text](https://refactoring.guru/images/patterns/diagrams/builder/problem2.png "Builder")

> Çok sayıda parametreye sahip yapıcının dezavantajı vardır: tüm parametrelere her zaman ihtiyaç duyulmaz.

Çoğu durumda parametrelerin çoğu kullanılmaz, bu da yapıcı çağrılarını oldukça çirkin hale getirir. Örneğin, evlerin sadece bir kısmında yüzme havuzu vardır, bu nedenle yüzme havuzlarıyla ilgili parametreler onda dokuz kez işe yaramaz olacaktır.

## Çözüm

Builder modeli, nesne oluşturma kodunu kendi sınıfından çıkarmanızı ve builders adı verilen ayrı nesnelere taşımanızı önerir.

![alt text](https://refactoring.guru/images/patterns/diagrams/builder/solution1.png "Builder")
> Builder deseni, karmaşık nesneleri adım adım oluşturmanıza olanak tanır. Builder, ürün oluşturulurken başka nesnelerin ürüne erişmesine izin vermez.

Kalıp, nesne yapımını bir dizi adım halinde düzenler (buildWalls, buildDoor, vb.). Bir nesne oluşturmak için, bu adımların bir dizisini oluşturucu nesne üzerinde yürütürsünüz. Önemli olan, tüm adımları aramanıza gerek olmamasıdır. Yalnızca bir nesnenin belirli bir konfigürasyonunu oluşturmak için gerekli olan adımları çağırabilirsiniz.

Ürünün çeşitli temsillerini oluşturmanız gerektiğinde, yapım adımlarından bazıları farklı uygulama gerektirebilir. Örneğin bir kulübenin duvarları ahşap olabilir ama kale duvarları taştan yapılmalıdır.

Bu durumda, aynı oluşturma adımlarını farklı bir şekilde uygulayan birkaç farklı oluşturucu sınıfı oluşturabilirsiniz. Ardından, farklı türde nesneler üretmek için bu Builders inşaat sürecinde (yani, inşa etme adımlarına yapılan sıralı bir dizi çağrı) kullanabilirsiniz.

![alt text](https://refactoring.guru/images/patterns/content/builder/builder-comic-1-en.png "Builder")
> Farklı inşaatçılar aynı görevi çeşitli şekillerde yürütür.

Örneğin, her şeyi ahşap ve camdan inşa eden bir inşaatçı, her şeyi taş ve demirle inşa eden ikinci bir inşaatçı ve altın ve elmas kullanan üçüncü bir inşaatçı hayal edin. Aynı adımları izleyerek, ilk inşaatçıdan normal bir ev, ikinciden küçük bir kale ve üçüncüden bir saray alırsınız. Ancak, bu yalnızca, oluşturma adımlarını çağıran istemci kodu, ortak bir arabirim kullanarak builderlarla etkileşim kurabiliyorsa işe yarar.

#### Director 

Daha da ileri gidebilir ve bir ürünü oluşturmak için kullandığınız oluşturucu adımlarına bir dizi çağrıyı yönetmen adı verilen ayrı bir sınıfa çıkarabilirsiniz. Director sınıfı, oluşturma adımlarının yürütüleceği sırayı tanımlarken, builder bu adımlar için uygulama sağlar.

![alt text](https://refactoring.guru/images/patterns/content/builder/builder-comic-2-en.png "Builder")
> Director, çalışan bir ürün elde etmek için hangi yapım adımlarının uygulanacağını bilir.

Programınızda bir yönetmen sınıfına sahip olmak kesinlikle gerekli değildir. Oluşturma adımlarını her zaman doğrudan müşteri kodundan belirli bir sırada çağırabilirsiniz. Bununla birlikte, yönetmen sınıfı, programınızda yeniden kullanabilmeniz için çeşitli yapım rutinlerini koymak için iyi bir yer olabilir.

Ek olarak, Director sınıfı, ürün yapımının ayrıntılarını müşteri kodundan tamamen gizler. Müşterinin yalnızca bir inşaatçıyı bir Directorle ilişkilendirmesi, inşaatı directorle başlatması ve inşaatçıdan sonucu alması gerekir.

##  Structure

![alt text](https://refactoring.guru/images/patterns/diagrams/builder/structure.png "Builder")

1. Builder arabirimi, tüm oluşturucu türleri için ortak olan ürün oluşturma adımlarını bildirir.
2. Concrete Yapıcılar, inşaat adımlarının farklı uygulamalarını sağlar. Concrete üreticileri, ortak arayüzü takip etmeyen ürünler üretebilir.
3. Ürünler sonuç nesneleridir. Farklı oluşturucular tarafından oluşturulan ürünlerin aynı sınıf hiyerarşisine veya arabirime ait olması gerekmez.
4. Director sınıfı, belirli ürün konfigürasyonlarını oluşturabilmeniz ve yeniden kullanabilmeniz için yapım adımlarının çağrılacağı sırayı tanımlar.
5. İstemci, oluşturucu nesnelerinden birini directorle ilişkilendirmelidir. Genellikle, directorin yapıcısının parametreleri aracılığıyla yalnızca bir kez yapılır. Ardından yönetmen, diğer tüm inşaatlar için bu oluşturucu nesneyi kullanır. Ancak, istemci oluşturucu nesnesini yönetmenin üretim yöntemine aktardığında alternatif bir yaklaşım vardır. Bu durumda, yönetmenle birlikte her üretim yaptığınızda farklı bir oluşturucu kullanabilirsiniz.

## Sözde kod 

Builder modelinin bu örneği, arabalar gibi farklı türde ürünler oluştururken aynı nesne yapım kodunu nasıl yeniden kullanabileceğinizi ve bunlara karşılık gelen kılavuzları nasıl oluşturabileceğinizi gösterir.

![alt text](https://refactoring.guru/images/patterns/diagrams/builder/example-en.png "Builder")
> Arabaların adım adım yapım örneği ve bu araba modellerine uyan kullanım kılavuzları.

- Builder: Product nesnesinin oluşturulması için gerekli soyut arayüzü sunar.

- ConcreteBuilder: Product nesnesini oluşturur. Product ile ilişkili temel özellikleri de uygular.

- Director: Builder arayüzünü kullanarak nesne örneklemesini yapar.

- Product: Üretim sonucu ortaya çıkan nesneyi temsil eder. Dahili yapısı(örneğin temel özellikleri) ConcreteBuilder tarafından inşa edilir.

Bir araba, yüzlerce farklı şekilde inşa edilebilen karmaşık bir nesnedir. Araba sınıfını devasa bir yapıcıyla şişirmek yerine, araba montaj kodunu ayrı bir araba üreticisi sınıfına çıkardık. Bu sınıf, bir arabanın çeşitli parçalarını yapılandırmak için bir dizi yönteme sahiptir.

İstemci kodunun özel, ince ayarlı bir araba modeli oluşturması gerekiyorsa, doğrudan oluşturucuyla birlikte çalışabilir. Öte yandan, müşteri, montajı, en popüler araba modellerinden birkaçını inşa etmek için bir inşaatçıyı nasıl kullanacağını bilen yönetmen sınıfına devredebilir. 

Şok olmuş olabilirsiniz ama her arabanın bir kullanım kılavuzuna ihtiyacı vardır (cidden, onları kim okur?). Kılavuz, aracın her özelliğini açıklar, bu nedenle kılavuzlardaki ayrıntılar farklı modellere göre değişir. Bu nedenle, mevcut bir yapım sürecini hem gerçek arabalar hem de ilgili kılavuzlar için yeniden kullanmak mantıklıdır. Tabii ki, bir kılavuz oluşturmak, bir araba yapmakla aynı şey değildir ve bu nedenle, kılavuz oluşturma konusunda uzmanlaşmış başka bir inşaatçı sınıfı sağlamalıyız. Bu sınıf, araba yapan kardeşiyle aynı yapım yöntemlerini uygular, ancak araba parçaları yapmak yerine onları tanımlar. Bu oluşturucuları aynı direktör nesnesine geçirerek, bir araba veya bir kılavuz oluşturabiliriz.

Son kısım, ortaya çıkan nesneyi getiriyor. Bir metal araba ve bir kağıt el kitabı, birbiriyle ilişkili olmasına rağmen, yine de çok farklı şeylerdir. Yönetmeni somut ürün sınıflarına bağlamadan, yönetmene sonuç almak için bir yöntem yerleştiremeyiz. Dolayısıyla işi yapan inşaatçıdan inşaatın sonucunu alıyoruz.

```java
// Using the Builder pattern makes sense only when your products
// are quite complex and require extensive configuration. The
// following two products are related, although they don't have
// a common interface.
class Car is
    // A car can have a GPS, trip computer and some number of
    // seats. Different models of cars (sports car, SUV,
    // cabriolet) might have different features installed or
    // enabled.

class Manual is
    // Each car should have a user manual that corresponds to
    // the car's configuration and describes all its features.


// The builder interface specifies methods for creating the
// different parts of the product objects.
interface Builder is
    method reset()
    method setSeats(...)
    method setEngine(...)
    method setTripComputer(...)
    method setGPS(...)

// The concrete builder classes follow the builder interface and
// provide specific implementations of the building steps. Your
// program may have several variations of builders, each
// implemented differently.
class CarBuilder implements Builder is
    private field car:Car

    // A fresh builder instance should contain a blank product
    // object which it uses in further assembly.
    constructor CarBuilder() is
        this.reset()

    // The reset method clears the object being built.
    method reset() is
        this.car = new Car()

    // All production steps work with the same product instance.
    method setSeats(...) is
        // Set the number of seats in the car.

    method setEngine(...) is
        // Install a given engine.

    method setTripComputer(...) is
        // Install a trip computer.

    method setGPS(...) is
        // Install a global positioning system.

    // Concrete builders are supposed to provide their own
    // methods for retrieving results. That's because various
    // types of builders may create entirely different products
    // that don't all follow the same interface. Therefore such
    // methods can't be declared in the builder interface (at
    // least not in a statically-typed programming language).
    //
    // Usually, after returning the end result to the client, a
    // builder instance is expected to be ready to start
    // producing another product. That's why it's a usual
    // practice to call the reset method at the end of the
    // `getProduct` method body. However, this behavior isn't
    // mandatory, and you can make your builder wait for an
    // explicit reset call from the client code before disposing
    // of the previous result.
    method getProduct():Car is
        product = this.car
        this.reset()
        return product

// Unlike other creational patterns, builder lets you construct
// products that don't follow the common interface.
class CarManualBuilder implements Builder is
    private field manual:Manual

    constructor CarManualBuilder() is
        this.reset()

    method reset() is
        this.manual = new Manual()

    method setSeats(...) is
        // Document car seat features.

    method setEngine(...) is
        // Add engine instructions.

    method setTripComputer(...) is
        // Add trip computer instructions.

    method setGPS(...) is
        // Add GPS instructions.

    method getProduct():Manual is
        // Return the manual and reset the builder.


// The director is only responsible for executing the building
// steps in a particular sequence. It's helpful when producing
// products according to a specific order or configuration.
// Strictly speaking, the director class is optional, since the
// client can control builders directly.
class Director is
    // The director works with any builder instance that the
    // client code passes to it. This way, the client code may
    // alter the final type of the newly assembled product.
    // The director can construct several product variations
    // using the same building steps.
    method constructSportsCar(builder: Builder) is
        builder.reset()
        builder.setSeats(2)
        builder.setEngine(new SportEngine())
        builder.setTripComputer(true)
        builder.setGPS(true)

    method constructSUV(builder: Builder) is
        // ...


// The client code creates a builder object, passes it to the
// director and then initiates the construction process. The end
// result is retrieved from the builder object.
class Application is

    method makeCar() is
        director = new Director()

        CarBuilder builder = new CarBuilder()
        director.constructSportsCar(builder)
        Car car = builder.getProduct()

        CarManualBuilder builder = new CarManualBuilder()
        director.constructSportsCar(builder)

        // The final product is often retrieved from a builder
        // object since the director isn't aware of and not
        // dependent on concrete builders and products.
        Manual manual = builder.getProduct()

```

## Uygulanabilirlik

**"İç içe geçen oluşturucudan (telescoping constructor)" kurtulmak için Oluşturucu modelini kullanın.**

On isteğe bağlı parametreye sahip bir oluşturucunuz olduğunu varsayalım. Böyle bir canavarı aramak çok sakıncalıdır; bu nedenle, oluşturucuyu aşırı yüklersiniz ve daha az parametreyle birkaç daha kısa sürüm oluşturursunuz. Bu kurucular, bazı varsayılan değerleri atlanan parametrelere ileterek hala ana olana atıfta bulunur.

```java

class Pizza {
    Pizza(int size) { ... }
    Pizza(int size, boolean cheese) { ... }
    Pizza(int size, boolean cheese, boolean pepperoni) { ... }
     // ...

```
> Böyle bir canavar oluşturmak, yalnızca C# veya Java gibi aşırı yöntem yüklemeyi destekleyen dillerde mümkündür.

Builder modeli, yalnızca gerçekten ihtiyacınız olan adımları kullanarak nesneleri adım adım oluşturmanıza olanak tanır. Modeli uyguladıktan sonra, artık kurucularınıza düzinelerce parametre sıkıştırmanız gerekmez.

**Kodunuzun bazı ürünlerin (örneğin, taş ve ahşap evler) farklı temsillerini oluşturabilmesini istediğinizde builder modelini kullanın.**

Builder modeli, ürünün çeşitli temsillerinin inşası, yalnızca ayrıntılarda farklılık gösteren benzer adımları içerdiğinde uygulanabilir.

Temel builder arabirimi, tüm olası yapım adımlarını tanımlar ve somut oluşturucular, ürünün belirli temsillerini oluşturmak için bu adımları uygular. Bu sırada yönetmen sınıfı yapım düzenine yön verir.

**Bileşik ağaçlar veya diğer karmaşık nesneler oluşturmak için Builder'yu kullanın.**

Builder modeli, ürünleri adım adım oluşturmanıza olanak tanır. Nihai ürünü bozmadan bazı adımların yürütülmesini erteleyebilirsiniz. Adımları yinelemeli olarak bile arayabilirsiniz; bu, bir nesne ağacı oluşturmanız gerektiğinde kullanışlıdır.

Bir inşaatçı, inşaat adımlarını yürütürken bitmemiş ürünü ortaya çıkarmaz. Bu, istemci kodunun eksik bir sonuç getirmesini engeller.

## Nasıl Uygulanır?

1. Mevcut tüm ürün temsillerini oluşturmak için ortak yapım adımlarını açıkça tanımlayabildiğinizden emin olun. Aksi takdirde, kalıbı uygulamaya devam edemezsiniz.
2. Temel oluşturucu arayüzünde bu adımları bildirin.
3. Ürün temsillerinin her biri için bir concrete oluşturucu sınıfı oluşturun ve bunların yapım adımlarını uygulayın. İnşanın sonucunu almak için bir yöntem uygulamayı unutmayın. Bu yöntemin oluşturucu arabiriminde bildirilememesinin nedeni, çeşitli oluşturucuların ortak bir arabirimi olmayan ürünler oluşturabilmesidir. Bu nedenle, böyle bir yöntemin dönüş türünün ne olacağını bilmiyorsunuz. Ancak, tek bir hiyerarşideki ürünlerle uğraşıyorsanız, getirme yöntemi temel arayüze güvenle eklenebilir.
4. Bir yönetmen sınıfı oluşturmayı düşünün. Aynı oluşturucu nesneyi kullanarak bir ürün oluşturmanın çeşitli yollarını kapsayabilir.
5. Client kodu, hem oluşturucu hem de director nesnelerini oluşturur. İnşaat başlamadan önce müşteri, yöneticiye bir oluşturucu nesnesi iletmelidir. Genellikle istemci, yönetmenin sınıf oluşturucusunun parametreleri aracılığıyla bunu yalnızca bir kez yapar. Director, sonraki tüm yapımlarda oluşturucu nesnesini kullanır. Directorun, yönetmenin belirli bir ürün oluşturma yöntemine geçtiği alternatif bir yaklaşım var.
6. Yapım sonucu, ancak tüm ürünler aynı arayüzü takip ederse direkt olarak direktörden alınabilir. Aksi takdirde, müşteri sonucu oluşturucudan almalıdır.

## Faydaları ve Dezavantajları

### Faydaları

- Nesneleri adım adım inşa edebilir, yapım adımlarını erteleyebilir veya adımları yinelemeli olarak çalıştırabilirsiniz. 
- Ürünlerin çeşitli temsillerini oluştururken aynı yapı kodunu yeniden kullanabilirsiniz. 
- Tek Sorumluluk İlkesi. Karmaşık yapı kodunu ürünün iş mantığından ayırabilirsiniz.

### Dezavantajları

- Model, birden çok yeni sınıf oluşturmayı gerektirdiğinden, kodun genel karmaşıklığı artar.

## Diğer Kalıplarla İlişkiler

- Pek çok tasarım, Fabrika Yöntemi (alt sınıflar aracılığıyla daha az karmaşık ve daha özelleştirilebilir) kullanılarak başlar ve Abstract Factory, Prototype, veya Builder a (daha esnek, ancak daha karmaşık) doğru gelişir.

- Builder, adım adım karmaşık nesneler oluşturmaya odaklanır. Abstract Factory, ilgili nesnelerin ailelerini oluşturma konusunda uzmanlaşmıştır. Abstract Factory ürünü hemen iade ederken, Builder ürünü getirmeden önce bazı ek yapım adımlarını uygulamanıza izin verir.

- Builder'ı karmaşık Bileşik ağaçlar oluştururken kullanabilirsiniz çünkü yapım adımlarını yinelemeli çalışacak şekilde programlayabilirsiniz.

- Builder ile Bridge'i birleştirebilirsiniz: Director sınıfı soyutlama rolünü üstlenirken, farklı oluşturucular uygulama görevi görür.

- Abstract Factories, Builders ve Prototypes tümü Singleton olarak uygulanabilir.





